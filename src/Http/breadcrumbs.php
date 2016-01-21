<?php
$config_file = config('neptrox.product-basket-config');

Breadcrumbs::register(config($config_file.'.admin:product-basket.route'), function($breadcrumbs) use ($config_file)
{
    $breadcrumbs->parent('admin_home', route('admin_home'));
    $breadcrumbs->push('Basket', route(config($config_file.'.admin:product-basket.route')));
});

Breadcrumbs::register(config($config_file.'.admin:product-basket:create.route'), function($breadcrumbs) use ($config_file)
{
    $breadcrumbs->parent(config($config_file.'.admin:product-basket.route'), route(config($config_file.'.admin:product-basket.route')));
    $breadcrumbs->push('Create', route(config($config_file.'.admin:product-basket:create.route')));
});

Breadcrumbs::register(config($config_file.'.admin:product-basket:edit.route'), function($breadcrumbs) use ($config_file)
{
    $breadcrumbs->parent(config($config_file.'.admin:product-basket.route'), route(config($config_file.'.admin:product-basket.route')));
    $breadcrumbs->push('Edit', route(config($config_file.'.admin:product-basket:edit.route')));
});
