<?php

namespace Neptrox\ProductBasket\Http\Controllers\Frontend\Shopping;

use App\Http\Controllers\Frontend\Shopping\ProductBaseController;
use App\Http\Requests;
use AppHelper;
use Neptrox\ProductBasket\Models\ProductBasket;

class ProductBasketController extends ProductBaseController
{
    protected $model;
    protected $productBasketData;
    protected $config_file_name;
    protected $view_path = 'neptrox-product-basket::frontend.shopping.product';

    protected $trans_path;

    public function __construct()
    {
        parent:: __construct();

        $this->config_file_name = config('neptrox.product-basket-config');
        $this->model = config($this->config_file_name.'.model.path.ProductBasket');
        $this->productBasketData = config($this->config_file_name.'.model.path.ProductBasketData');
        // Generate Translation Dir path
        $this->trans_path = AppHelper::getTransPathFromViewPath($this->view_path);
    }

    public function productAction($url)
    {
        parent::activeProductExistByLang('slug', $url);

        $category_list = parent::getActiveCategoryList();
        $special_products = parent::getSpecialProducts();

        $productModel = $this->model;
        $product = $productModel::ByDefaultLang()
            ->where('slug', $url)
            ->first();

        $productDataModel = $this->productBasketData;
        $productData = $productDataModel::where('product_id', $product->primary_key)->first();
        parent::incrementProductViewCount($productData);

        $attribute_values = parent::getProductAttributes($product->primary_key);
        $productImages = parent::getProductImageGallery($product->primary_key);
        $productList = $this->getProductsOnBasket($productData->custom_field);

        return view($this->loadDefaultVars($this->view_path . '.product', $product), compact('category_list', 'special_products', 'product', 'productData', 'productList', 'attribute_values', 'productImages', 'productReviews'))->with([
            'product_view_path' => 'frontend.shopping.product'
        ]);
    }

    protected function getProductsOnBasket($custom_field)
    {
        $data = json_decode($custom_field, 1);
        if (!array_key_exists('products_on_basket', is_array($data)?$data:[]))
            return [];

        $product_pks = explode(',', $data['products_on_basket']);
        $productModel = $this->model;
        $data = $productModel::select('ec_product.primary_key', 'ec_product.name', 'ec_product.slug', 'epd.price', 'epd.quantity', 'epd.image', 'ept.url as product_type')
            ->leftJoin('ec_product_data as epd', 'ec_product.primary_key', '=', 'epd.product_id')
            ->leftJoin('ec_product_type as ept', 'epd.product_type_id', '=', 'ept.id')
            ->whereIn('ec_product.primary_key', $product_pks)
            ->where('epd.product_type_id', parent::getProductTypeId('simple-product'))
            ->groupBy('ec_product.primary_key')
            ->ByDefaultLang()
            ->get();

        return $data;
    }

}
