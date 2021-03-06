<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Product Types Table name
    |--------------------------------------------------------------------------
    |
    */
    'product-types-table' => 'ec_product_type',

    /*
    |--------------------------------------------------------------------------
    | Model Configs
    |--------------------------------------------------------------------------
    |
    */
    'model' => [
        'path' => [
            'ProductBasket' => '\\Neptrox\\ProductBasket\\Models\\ProductBasket',
            'ProductBasketData' => '\\Neptrox\\ProductBasket\\Models\\ProductBasketData',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Routes for product basket
    |--------------------------------------------------------------------------
    | "route" index must not be modified
    |
    */
    'product-basket' => [
        'url' => 'product-basket/{url}',
        'route' => 'product-basket',
        'controller' => 'Neptrox\ProductBasket\Http\Controllers\Frontend\Shopping\ProductBasketController@productAction'
    ],
    'admin:product-basket' => [
        'url' => 'product-basket',
        'route' => 'admin.product-basket',
        'controller' => 'Neptrox\ProductBasket\Http\Controllers\Admin\Shopping\ProductBasketController@index'
    ],
    'admin:product-basket:create' => [
        'url' => 'product-basket/create',
        'route' => 'admin.product-basket.create',
        'controller' => 'Neptrox\ProductBasket\Http\Controllers\Admin\Shopping\ProductBasketController@create'
    ],
    'admin:product-basket:attribute-value-html' => [
        'url' => 'product-basket/attribute-value-html',
        'route' => 'admin.product-basket.attribute-value-html',
        'controller' => 'Neptrox\ProductBasket\Http\Controllers\Admin\Shopping\ProductBasketController@getAttributeValuesView'
    ],
    'admin:product-basket:attribute-value-row' => [
        'url' => 'product-basket/attribute-value-row/{index}',
        'route' => 'admin.product-basket.attribute-value-row',
        'controller' => 'Neptrox\ProductBasket\Http\Controllers\Admin\Shopping\ProductBasketController@getAttributeValueRow'
    ],
    'admin:product-basket:multiple-image-html' => [
        'url' => 'product-basket/multiple-image-html',
        'route' => 'admin.product-basket.multiple-image-html',
        'controller' => 'Neptrox\ProductBasket\Http\Controllers\Admin\Shopping\ProductBasketController@getMultipleImageView'
    ],
    'admin:product-basket:multiple-image-row' => [
        'url' => 'product-basket/multiple-image-row/{index}',
        'route' => 'admin.product-basket.multiple-image-row',
        'controller' => 'Neptrox\ProductBasket\Http\Controllers\Admin\Shopping\ProductBasketController@getMultipleImageRow'
    ],
    'admin:product-basket:store' => [
        'url' => 'product-basket/store',
        'route' => 'admin.product-basket.store',
        'controller' => 'Neptrox\ProductBasket\Http\Controllers\Admin\Shopping\ProductBasketController@store'
    ],
    'admin:product-basket:edit' => [
        'url' => 'product-basket/{id}/edit',
        'route' => 'admin.product-basket.edit',
        'controller' => 'Neptrox\ProductBasket\Http\Controllers\Admin\Shopping\ProductBasketController@edit'
    ],
    'admin:product-basket:update' => [
        'url' => 'product-basket/{id}/update',
        'route' => 'admin.product-basket.update',
        'controller' => 'Neptrox\ProductBasket\Http\Controllers\Admin\Shopping\ProductBasketController@update'
    ],
    'admin:product-basket:confirm-delete' => [
        'url' => 'product-basket/{id}/confirm-delete',
        'route' => 'admin.product-basket.confirm-delete',
        'controller' => 'Neptrox\ProductBasket\Http\Controllers\Admin\Shopping\ProductBasketController@getModalDelete'
    ],
    'admin:product-basket:delete' => [
        'url' => 'product-basket/{id}/delete',
        'route' => 'admin.product-basket.delete',
        'controller' => 'Neptrox\ProductBasket\Http\Controllers\Admin\Shopping\ProductBasketController@destroy'
    ],
    'admin:product-basket:product-search' => [
        'url' => 'product-basket/product-search',
        'route' => 'admin.product-basket.product-search',
        'controller' => 'Neptrox\ProductBasket\Http\Controllers\Admin\Shopping\ProductBasketController@searchByName'
    ],
    'admin:product-basket:get-product-info' => [
        'url' => 'product-basket/get-product-info',
        'route' => 'admin.product-basket.get-product-info',
        'controller' => 'Neptrox\ProductBasket\Http\Controllers\Admin\Shopping\ProductBasketController@getProductInfos'
    ],
    'admin:product-basket:set-perishable' => [
        'url' => 'product-basket/{id}/set-perishable',
        'route' => 'admin.product-basket.set-perishable',
        'controller' => 'Neptrox\ProductBasket\Http\Controllers\Admin\Shopping\ProductBasketController@setPerishable'
    ],
    'admin:product-basket:set-special' => [
        'url' => 'product-basket/{id}/set-special',
        'route' => 'admin.product-basket.set-special',
        'controller' => 'Neptrox\ProductBasket\Http\Controllers\Admin\Shopping\ProductBasketController@setSpecial'
    ],
    'admin:product-basket:set-featured' => [
        'url' => 'product-basket/{id}/set-featured',
        'route' => 'admin.product-basket.set-featured',
        'controller' => 'Neptrox\ProductBasket\Http\Controllers\Admin\Shopping\ProductBasketController@setFeatured'
    ],

    /*
    |--------------------------------------------------------------------------
    | Product Type Badge HTML
    |--------------------------------------------------------------------------
    |
    */
    'show-badge' => true,
    'badge-html' => '<div class="new_label_product" data-toggle="tooltip" data-placement="top" title="Basket">
                        <span class="product-label-new">
                            <i class="fa fa-shopping-basket"></i>
                        </span>
                    </div>',

];