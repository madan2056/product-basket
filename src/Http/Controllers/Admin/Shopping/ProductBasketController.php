<?php
namespace Neptrox\ProductBasket\Http\Controllers\Admin\Shopping;

use App\Http\Controllers\Admin\Shopping\ProductController;
use DB;
use Neptrox\ProductBasket\Models\ProductBasket;
use AppHelper;
use Illuminate\Http\Request;
use Neptrox\ProductBasket\Models\ProductBasketData;

class ProductBasketController extends ProductController
{
    /**
     * Name of Model
     *
     * @var string
     */
    protected $model = '\\Neptrox\\ProductBasket\\Models\\ProductBasket';

    /**
     * Used to Store Data
     * @var
     */
    protected $data;

    /**
     * @var view location path
     */
    protected $view_path = 'neptrox-product-basket::admin.shopping.product';

    protected $config_file_name;
    protected $productBasketData;

    public function __construct()
    {
        parent::__construct();

        $this->config_file_name = config('neptrox.product-basket-config');
        $this->model = config($this->config_file_name.'.model.path.ProductBasket');
        $this->productBasketData = config($this->config_file_name.'.model.path.ProductBasketData');
        $this->base_route = config($this->config_file_name.'.admin:product-basket.route');
        $this->trans_path = AppHelper::getTransPathFromViewPath($this->view_path);
        $this->product_type_url = 'product-basket';

    }

    public function edit($pk)
    {
        $data = $this->__getDataForEdit($pk);
        $data['basket_detail'] = $this->getProductsOnBasket($data['custom_field']);
        return view($this->loadDefaultVars($this->view_path . '.edit'), compact('data'));
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

}