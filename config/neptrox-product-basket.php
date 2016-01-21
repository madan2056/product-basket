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

];