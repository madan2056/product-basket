<?php

namespace Neptrox\ProductBasket\Http\Controllers\Frontend\Shopping;

use App\Http\Controllers\Frontend\Shopping\ProductController;
use App\Http\Requests;
use AppHelper;
use Neptrox\ProductBasket\Models\ProductBasket;
use Neptrox\ProductBasket\Models\ProductBasketData;

class ProductBasketController extends ProductController
{
    protected $view_path = 'neptrox-product-basket::frontend.shopping.product';

    protected $trans_path;

    public function __construct()
    {
        parent:: __construct();

        // Generate Translation Dir path
        $this->trans_path = AppHelper::getTransPathFromViewPath($this->view_path);
    }

    public function productAction($url)
    {
        $this->activeProductExistByLang('slug', $url);

        // Parent Category List
        $category_list = parent::getActiveCategoryList();

        // Special Products
        $special_products = parent::getSpecialProducts();

        $product = ProductBasket::ByDefaultLang()
            ->where('slug', $url)
            ->first();

        echo $url;
        AppHelper::debug($product);

        $productData = ProductBasketData::where('product_id', $product->primary_key)->first();

        AppHelper::debug($productData,1);
        $this->incrementProductViewCount($productData);

        $productList = $this->getProductsOnBasket($productData->custom_field);

        $attribute_values = $this->getProductAttributes($product->primary_key);

        $productImages = $this->getProductImageGallery($product->primary_key);

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
        $data = ProductBasket::select('ec_product.primary_key', 'ec_product.name', 'ec_product.slug', 'epd.price', 'epd.quantity', 'epd.image', 'ept.url as product_type')
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
