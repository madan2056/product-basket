<?php
$config_file = 'neptrox-product-basket';


return [
    'product-basket' => [
        'level' => 2,
        'parent' => 'catalog',
        'menu' => [
            /* Product  Basket */
            'product-basket' => [
                'key' => 'product-basket',
                'acl_auth' => [config($config_file.'.admin:product-basket.route')],
                'active_if_request_is' => ['admin/product-basket*'],
                'display_order' => 52,
                'a' => [
                    'route' => config($config_file.'.admin:product-basket.route'),
                    'content' => 'Product Basket',
                ]
            ],
            /* End: Product  Basket */
        ],
    ],

];