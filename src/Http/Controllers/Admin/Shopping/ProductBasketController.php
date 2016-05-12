<?php
namespace Neptrox\ProductBasket\Http\Controllers\Admin\Shopping;

use App\Http\Controllers\Admin\Shopping\ProductBaseController;
use App\Http\Requests\Admin\Shopping\Product\CreateProductValidationRequest;
use App\Http\Requests\Admin\Shopping\Product\EditProductValidationRequest;
use App\Models\Media;
use App\Models\ProductMedia;
use DB;
use Flash;
use Neptrox\ProductBasket\Models\ProductBasket;
use AppHelper;
use Illuminate\Http\Request;
use Neptrox\ProductBasket\Models\ProductBasketData;
use View;

class ProductBasketController extends ProductBaseController
{
    /**
     * Name of Model
     *
     * @var string
     */
    protected $model;

    /**
     * @var view location path
     */
    protected $view_path = 'neptrox-product-basket::admin.shopping.product';
    protected $product_type_url = 'product-basket';
    protected $config_file_name;
    protected $productBasketData;
    protected $admin_pagination_limit = 200;

    protected $search_query = [];

    public function __construct()
    {
        parent::__construct();

        $this->config_file_name = config('neptrox.product-basket-config');
        $this->model = config($this->config_file_name.'.model.path.ProductBasket');
        $this->productBasketData = config($this->config_file_name.'.model.path.ProductBasketData');
        $this->base_route = config($this->config_file_name.'.admin:product-basket.route');
        $this->trans_path = AppHelper::getTransPathFromViewPath($this->view_path);

    }

    public function index(Request $request)
    {
        $productModel = $this->model;
        $data = $productModel::select('ec_product.primary_key', 'ec_product.name', 'pd.image', 'pd.price', 'pd.quantity', 'pd.status', 'pd.is_perishable','pd.is_special','pd.is_featured', 'pd.created_at')
            ->leftJoin('ec_product_data as pd', 'ec_product.primary_key', '=', 'pd.product_id')
            ->where('pd.product_type_id', parent::getProductTypeId($this->product_type_url))
            ->where(function($query) use ($request) {
                $this->buildSearchQuery($query, $request);
            })
            ->groupBy('ec_product.primary_key')
            ->ByDefaultLang()
            ->paginate($this->admin_pagination_limit);
        $search_query = $this->search_query;
        return view($this->loadDefaultVars($this->view_path . '.index'), compact('data', 'search_query'));
    }

    protected function buildSearchQuery($query, $request)
    {
        if ($request->has('product-id-from') && $request->has('product-id-to')) {
            $query->whereBetween('ec_product.primary_key', [(int) $request->get('product-id-from'), (int) $request->get('product-id-to')]);
            $this->search_query['product-id-from'] = $request->get('product-id-from');
            $this->search_query['product-id-to'] = $request->get('product-id-to');
        }
        elseif ($request->has('product-id-from')) {
            $query->where('ec_product.primary_key', '>=', (int) $request->get('product-id-from'));
            $this->search_query['product-id-from'] = $request->get('product-id-from');
        }
        elseif ($request->has('product-id-to')) {
            $query->where('ec_product.primary_key', '<=', (int) $request->get('product-id-to'));
            $this->search_query['product-id-to'] = $request->get('product-id-to');
        }

        if ($request->has('product-name')) {
            $query->where('ec_product.name', 'like', '%' . $request->get('product-name') . '%');
            $this->search_query['product-name'] = $request->get('product-name');
        }

        if ($request->has('product-status')) {

            if (in_array($request->get('product-status'), ['active', 'inactive']))
                $query->where('pd.status', $request->get('product-status') == 'active'?1:0);

            $this->search_query['product-status'] = $request->get('product-status');
        }


        if ($request->has('product-price-from') && $request->has('product-price-to')) {
            $query->whereBetween('pd.price', [$request->get('product-price-from'), $request->get('product-price-to')]);
            $this->search_query['product-price-from'] = $request->get('product-price-from');
            $this->search_query['product-price-to'] = $request->get('product-price-to');
        }
        elseif ($request->has('product-price-from')) {
            $query->where('pd.price', '>=', $request->get('product-price-from'));
            $this->search_query['product-price-from'] = $request->get('product-price-from');
        }
        elseif ($request->has('product-price-to')) {
            $query->where('pd.price', '<=', $request->get('product-price-to'));
            $this->search_query['product-price-to'] = $request->get('product-price-to');
        }

        if ($request->has('product-quantity-from') && $request->has('product-quantity-to')) {
            $query->whereBetween('pd.quantity', [$request->get('product-quantity-from'), $request->get('product-quantity-to')]);
            $this->search_query['product-quantity-from'] = $request->get('product-quantity-from');
            $this->search_query['product-quantity-to'] = $request->get('product-quantity-to');
        }
        elseif ($request->has('product-quantity-from'))
            $query->where('pd.quantity', '>=', $request->get('product-quantity-from'));
        elseif ($request->has('product-quantity-to'))
            $query->where('pd.quantity', '<=', $request->get('product-quantity-to'));

        if ($request->has('product-date-from') && $request->has('product-date-to'))
            $query->whereBetween('pd.created_at', [date('Y-m-d h:i:s', strtotime($request->get('product-date-from'))), date('Y-m-d h:i:s', strtotime($request->get('product-date-to')))]);
        elseif ($request->has('product-date-from'))
            $query->where('pd.created_at', '>=', date('Y-m-d h:i:s', strtotime($request->get('product-date-from'))));
        elseif ($request->has('product-date-to'))
            $query->where('pd.created_at', '<=', date('Y-m-d h:i:s', strtotime($request->get('product-date-to'))));


        return $query;
    }

    public function create()
    {
        $data = $this->getDataForAdd();
        return view(parent::loadDefaultVars($this->view_path . '.create'), compact('data'));

    }

    /**
     * Response with attribute value html
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAttributeValuesView()
    {
        $attribute = parent::__getAttrGroupedByAttrGroup();

        // make attribute values available to view
        if (request('for') && request('for') == 'edit' && request('key')) {
            $productModel = $this->model;
            $product = $productModel::pk(request('key'))->first();
            if (!$product) {
                return response('Unauthorized.', 401);
            }

            $attribute_values = DB::table('ec_product_attribute_pivot')->where('product_id', $product->primary_key)->get();
            $attribute_values = parent::__prepareAttributeValueByLang($attribute_values);
            $all_languages = parent::getAllLanguage();
            $default_lang_id = $this->default_lan_id;
        }


        $data = [
            'message' => 'Have Attribute values',
            'html' => view(parent::loadDefaultVars($this->view_path . '.partials._attribute_value_html'), compact('attribute', 'attribute_values', 'all_languages', 'default_lang_id'))->render()
        ];
        return response()->json(json_encode($data));
    }

    /**
     * Get Attribute Value Row
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAttributeValueRow($index)
    {
        $attribute = parent::__getAttrGroupedByAttrGroup();
        $data = [
            'message' => 'Have Attribute values',
            'html' => view(parent::loadDefaultVars($this->view_path . '.partials._attribute_value_row_html'), ['index' => $index, 'attribute' => $attribute])->render()
        ];
        return response()->json(json_encode($data));
    }

    /**
     * Response with Multiple Image Uploading html
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMultipleImageView()
    {
        $medias = '';

        // make option values available to view
        if (request('for') && request('for') == 'edit' && request('key')) {
            $productModel = $this->model;
            $product = $productModel::pk(request('key'))->first();
            if (!$product) {
                return response('Unauthorized.', 401);
            }

            $medias = DB::table('ec_product_media_pivot')
                ->select('m.media', 'ec_product_media_pivot.id', 'alt_tag', 'sort_order')
                ->leftJoin($this->media_table . ' as m', 'm.id', '=', 'media_id')
                ->orderBy('sort_order', 'asc')
                ->where('product_id', $product->primary_key)->get();
        }

        $data = [
            'message' => 'Have Multiple Image values',
            'html' => view(parent::loadDefaultVars($this->view_path . '.partials._multiple_image_html'), compact('medias'))->render()
        ];
        return response()->json(json_encode($data));
    }

    /**
     * Get Multiple Image Row
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMultipleImageRow($index)
    {
        $data = [
            'message' => 'Have  Multiple Image Row',
            'html' => view(parent::loadDefaultVars($this->view_path . '.partials._multiple_image_row_html'), ['index' => $index])->render()
        ];
        return response()->json(json_encode($data));
    }

    /**
     * Finds Product with Type "simple-product"
     *
     * @param Request $request
     * @return array|static[]
     */
    public function searchByName(Request $request)
    {
        $name = $request->input('query');
        $pk_to_exclude = ($request->input('loaded') !== '')?explode(',', $request->input('loaded')):[];
        $products = DB::table('ec_product as ep')
            ->select(DB::raw('ep.primary_key as id, ep.name as text'))
            ->leftJoin('ec_product_data as epd', 'ep.primary_key', '=', 'epd.product_id')
            ->where('ep.language_id', parent::getDefaultLanguageId())
            ->where('ep.name', 'like', "%$name%")
            ->where('epd.product_type_id', parent::getProductTypeId('simple-product'))
            ->whereNotIn('ep.primary_key', $pk_to_exclude)
            ->get();
        return $products;
    }

    /**
     * Returns product info for Basket Add / Update Form
     *
     * @param Request $request
     * @return mixed
     */
    public function getProductInfos(Request $request)
    {
        $pk = $request->input('id');

        $product = ProductBasket::select('ec_product.primary_key', 'ec_product.name', 'pd.image', 'pd.is_perishable', 'pd.is_special', 'pd.is_featured')
            ->leftJoin('ec_product_data as pd', 'ec_product.primary_key', '=', 'pd.product_id')
            ->ByDefaultLang()
            ->pk($pk)
            ->first();
        return $product;
    }

    public function store(CreateProductValidationRequest $request)
    {
        $product = parent::storeProduct($request, 'Product');
        $this->storeProductData($request, $product->primary_key);

        // Add Products Category
        if ($request->product_category)
            parent::storeProductCategory($request, $product->primary_key);

        parent::storeProductAttribute($request, $product->primary_key);

        parent::storeMultipleImage($request, $product->primary_key);

        Flash::success(trans($this->trans_path . 'general.status.created'));
        return $this->redirectToRoute();
    }

    public function edit($pk)
    {
        $data = $this->__getDataForEdit($pk);
        $data['basket_detail'] = $this->getProductsOnBasket($data['custom_field']);
        return view($this->loadDefaultVars($this->view_path . '.edit'), compact('data'));
    }

    public function update(EditProductValidationRequest $request, $pk)
    {
        $productModel = $this->model;
        if ($productModel::ByLang($this->getDefaultLanguageId())->pk($pk)->count() == 0) {
            Flash::warning(trans($this->trans_path . 'general.error.no-data-found'));
            return $this->redirectToRoute();
        }

        $url = parent::getUrl();
        if ($productModel::ByLang($this->getDefaultLanguageId())->where('primary_key', '!=', $pk)->where('slug', $url)->count() > 0) {
            Flash::warning(trans($this->trans_path . 'general.error.duplicate-url', ['url' => request('url')]));
            return redirect()->back()->withInput()->send();
        }

        $product = $this->updateByLang('Product', $pk, [
            'name' => $request->name,
            'slug' => $url,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ]);

        $productDataModel = $this->productBasketData;
        $productData = $productDataModel::where('product_id', $pk)->first();

        $this->existing_image = $productData->image;

        $productData->update([
            'image' => $this->__checkFileAndUpload($request),
            'sku' => $request->sku,
            'price' => $request->price,
            'weight_class_id' => $request->weight_in,
            'weight' => $request->weight,
            'quantity' => $request->quantity,
            'sort_order' => $request->sort_order,
            'status' => $request->status,
            'is_perishable' => $request->is_perishable,
            'is_special' => $request->is_special,
            'is_featured' => $request->is_featured,
        ]);

        if ($request->product_category) {

            // First remove product category relation
            parent::removeProductCategoryPivot('product_id', $product->primary_key);
            parent::storeProductCategory($request, $product->primary_key);

        }

        // Update Product Attribute Values
        parent::storeProductAttribute($request, $pk);

        parent::storeMultipleImage($request, $pk);

        Flash::success(trans($this->trans_path . 'general.status.updated'));
        return $this->redirectToRoute($pk);
    }

    public function destroy($pk)
    {
        // Check if primary_key matching $pk exist
        if (!$this->rowExist($this->model, $pk)) {
            Flash::error(trans($this->trans_path . 'general.error.no-data-found'));
            return $this->redirectToRoute();
        }

        $productModel = $this->model;
        $productDataModel = $this->productBasketData;
        $productData = $productDataModel::where('product_id', $pk)->first();

        // Remove Main Product Image
        if ($productData->image) {
            parent::__unlinkFile($this->imagePath, $productData->image);
            parent::__unlinkFileThumbnails($this->thumbnail_dimensions, $this->imagePath, $productData->image);
        }

        // Remove Multiple Images for Product
        $imgs = ProductMedia::where('product_id', $pk)->get(['id', 'media_id']);
        foreach ($imgs as $img) {
            $mediaObj = Media::find($img->media_id);

            // Remove old image
            parent::__unlinkFile($this->imagePath, $mediaObj->media);
            parent::__unlinkFileThumbnails($this->imgGalleryThumbDimension, $this->imagePath, $mediaObj->media);

            // Remove Data Form Media Table
            // This will remove child ProductMedia Data
            $mediaObj->delete();
        }

        // Remove Product
        // Product Attribute Value and Media Data
        // will be removed automatically due to FKey relation
        $productModel::pk($pk)->delete();

        Flash::success(trans($this->trans_path . 'general.status.deleted'));
        return $this->redirectToRoute();
    }

    /*set perishable product*/
    public function setPerishable($pk){

        $productModel = $this->model;
        $model = $productModel::ByLang($this->getDefaultLanguageId())->pk($pk)->first();

        // Check for valid primary_key
        if (empty($model)) {
            Flash::warning(trans($this->trans_path . 'general.error.no-data-found'));
            return $this->redirectToRoute();
        }

        $productDataModel = $this->productBasketData;
        $productData = $productDataModel::where('product_id', $pk)->first();

        if($productData->is_perishable == 0){
            $productData->is_perishable = 1;
        }elseif($productData->is_perishable == 1){
            $productData->is_perishable = 0;
        }
        $productData->save();

        Flash::success(trans($this->trans_path . 'general.status.updated'));
        return $this->redirectToRoute($pk);

    }

    /*set special product*/
    public function setSpecial($pk)
    {
        $productModel = $this->model;
        $model = $productModel::ByLang($this->getDefaultLanguageId())->pk($pk)->first();

        // Check for valid primary_key
        if (empty($model)) {
            Flash::warning(trans($this->trans_path . 'general.error.no-data-found'));
            return $this->redirectToRoute();
        }

        $productDataModel = $this->productBasketData;
        $productData = $productDataModel::where('product_id', $pk)->first();

        if($productData->is_special == 0){
            $productData->is_special = 1;
        }elseif($productData->is_special == 1){
            $productData->is_special = 0;
        }
        $productData->save();

        Flash::success(trans($this->trans_path . 'general.status.updated'));
        return $this->redirectToRoute($pk);

    }

    /*set featured product*/
    public function setFeatured($pk)
    {
        $productModel = $this->model;
        $model = $productModel::ByLang($this->getDefaultLanguageId())->pk($pk)->first();

        // Check for valid primary_key
        if (empty($model)) {
            Flash::warning(trans($this->trans_path . 'general.error.no-data-found'));
            return $this->redirectToRoute();
        }

        $productDataModel = $this->productBasketData;
        $productData = $productDataModel::where('product_id', $pk)->first();

        if($productData->is_featured == 0){
            $productData->is_featured = 1;
        }elseif($productData->is_featured == 1){
            $productData->is_featured = 0;
        }
        $productData->save();

        Flash::success(trans($this->trans_path . 'general.status.updated'));
        return $this->redirectToRoute($pk);

    }




    /*******************************************************************************
     *****************  HELPER METHODS  ********************************************
     ******************************************************************************/

    /**
     * Prepares all the data needed for create form
     *
     * @return array
     */
    protected function getDataForAdd()
    {
        $data = [];
        $data['ctgLists'] = parent::__getCategoryList();
        $data['category_dropdown'] = parent::findProductActiveCats(parent::changeToParentChildHierarchyForDropDown($data['ctgLists'], 'name'));
        $data['weight_classes'] = parent::__getWeightClassList();
        return $data;
    }

    /**
     * -- Overwrite parent method --
     * Add Product Data to ec_product_data table
     *
     * @param $request
     * @param $product_pk
     */
    protected function storeProductData($request, $product_pk)
    {
        ProductBasketData::create([
            'product_id' => $product_pk,
            'product_type_id' => parent::getProductTypeId($this->product_type_url),
            'image' => parent::__checkFileAndUpload($request),
            'sku' => $request->sku,
            'price' => $request->price,
            'weight_class_id' => $request->weight_in,
            'weight' => $request->weight,
            'quantity' => $request->quantity,
            'sort_order' => $request->sort_order,
            'status' => $request->status,
            'is_perishable' => $request->is_perishable,
            'is_special' => $request->is_special,
            'is_featured' => $request->is_featured,
            'custom_field' => $this->makeCustomFieldValues($request),
        ]);
    }

    protected function makeCustomFieldValues($request)
    {
        $data = [];

        // Products on Basket
        $data['products_on_basket'] = (isset($request->selected_products))?$request->selected_products:'';

        return json_encode($data);
    }

    protected function getProductsOnBasket($custome_field)
    {
        $data = json_decode($custome_field, 1);
        if (!array_key_exists('products_on_basket', is_array($data)?$data:[]))
            return [];

        $product_pks = explode(',', $data['products_on_basket']);
        $data['selected_products'] = $data['products_on_basket'];
        $data['products_on_basket'] = ProductBasket::select('ec_product.primary_key', 'ec_product.name', 'epd.image', 'epd.is_perishable','epd.is_special','epd.is_featured')
            ->leftJoin('ec_product_data as epd', 'ec_product.primary_key', '=', 'epd.product_id')
            ->whereIn('ec_product.primary_key', $product_pks)
            ->where('epd.product_type_id', parent::getProductTypeId('simple-product'))
            ->groupBy('ec_product.primary_key')
            ->ByDefaultLang()
            ->get();

        return $data;

    }

    /**
     * Prepare Data for Product Update Form
     *
     * @param $pk Product key
     * @return array Data array for Product Update Form
     */
    protected function __getDataForEdit($pk)
    {
        // Check if primary_key matching $pk exist
        if (!$this->rowExist($this->model, $pk)) {
            Flash::warning(trans($this->trans_path . 'general.error.no-data-found'));
            $this->redirectToRoute();
        }

        $productModel = $this->model;
        $product = $productModel::ByActiveLang()->pk($pk)->get();
        $data = $this->prepareDataByLang($product, ['name','short_description','description', 'meta_title', 'meta_description', 'meta_keywords']);

        $data['primary_key'] = $pk;
        $data['url'] = $product[0]->slug;
        $data['ctgLists'] = $this->__getCategoryList();
        $data['category_dropdown'] = $this->findProductActiveCats($this->changeToParentChildHierarchyForDropDown($data['ctgLists'], 'name'), $pk);

        $productDataModel = $this->productBasketData;
        $productData = $productDataModel::where('product_id', $product[0]->primary_key)->first();
        $data['product_data_id_field'] = '<input type="hidden" name="product_data_id" value="' . $productData->id . '">';
        $data['image'] = $productData->image;
        $data['sku'] = $productData->sku;
        $data['price'] = $productData->price;
        $data['weight_classes'] = parent::__getWeightClassList($productData->weight_class_id);
        $data['weight'] = $productData->weight;
        $data['quantity'] = $productData->quantity;
        $data['sort_order'] = $productData->sort_order;
        $data['status'] = $productData->status;
        $data['is_perishable'] = $productData->is_perishable;
        $data['is_special'] = $productData->is_special;
        $data['is_featured'] = $productData->is_featured;
        $data['custom_field'] = $productData->custom_field;

        return $data;
    }

}