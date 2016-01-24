<?php

$config_file = config('neptrox.product-basket-config');

Route::get( config($config_file.'.product-basket.url'),                      ['as' => config($config_file.'.product-basket.route'),                       'uses' => config($config_file.'.product-basket.controller')]);

// Routes in this group must be authorized.
Route::group(['middleware' => 'authorize'], function () use ($config_file) {

    // Site administration section
    Route::group(['prefix' => 'admin'], function () use ($config_file) {

        // Basket
        Route::get( config($config_file.'.admin:product-basket.url'),                                ['as' => config($config_file.'.admin:product-basket.route'),                               'uses' => config($config_file.'.admin:product-basket.controller')]);
        Route::get( config($config_file.'.admin:product-basket:create.url'),                         ['as' => config($config_file.'.admin:product-basket:create.route'),                        'uses' => config($config_file.'.admin:product-basket:create.controller')]);
        Route::get( config($config_file.'.admin:product-basket:attribute-value-html.url'),           ['as' => config($config_file.'.admin:product-basket:attribute-value-html.route'),          'uses' => config($config_file.'.admin:product-basket:attribute-value-html.controller')]);
        Route::get( config($config_file.'.admin:product-basket:attribute-value-row.url'),            ['as' => config($config_file.'.admin:product-basket:attribute-value-row.route'),           'uses' => config($config_file.'.admin:product-basket:attribute-value-row.controller')]);
        Route::get( config($config_file.'.admin:product-basket:multiple-image-html.url'),            ['as' => config($config_file.'.admin:product-basket:multiple-image-html.route'),           'uses' => config($config_file.'.admin:product-basket:multiple-image-html.controller')]);
        Route::get( config($config_file.'.admin:product-basket:multiple-image-row.url'),             ['as' => config($config_file.'.admin:product-basket:multiple-image-row.route'),            'uses' => config($config_file.'.admin:product-basket:multiple-image-row.controller')]);
        Route::post( config($config_file.'.admin:product-basket:store.url'),                         ['as' => config($config_file.'.admin:product-basket:store.route'),                         'uses' => config($config_file.'.admin:product-basket:store.controller')]);
        Route::get( config($config_file.'.admin:product-basket:edit.url'),                           ['as' => config($config_file.'.admin:product-basket:edit.route'),                          'uses' => config($config_file.'.admin:product-basket:edit.controller')]);
        Route::patch( config($config_file.'.admin:product-basket:update.url'),                       ['as' => config($config_file.'.admin:product-basket:update.route'),                        'uses' => config($config_file.'.admin:product-basket:update.controller')]);
        Route::get( config($config_file.'.admin:product-basket:confirm-delete.url'),                 ['as' => config($config_file.'.admin:product-basket:confirm-delete.route'),                'uses' => config($config_file.'.admin:product-basket:confirm-delete.controller')]);
        Route::get( config($config_file.'.admin:product-basket:delete.url'),                         ['as' => config($config_file.'.admin:product-basket:delete.route'),                        'uses' => config($config_file.'.admin:product-basket:delete.controller')]);
        Route::get( config($config_file.'.admin:product-basket:product-search.url'),                 ['as' => config($config_file.'.admin:product-basket:product-search.route'),                'uses' => config($config_file.'.admin:product-basket:product-search.controller')]);
        Route::post( config($config_file.'.admin:product-basket:get-product-info.url'),              ['as' => config($config_file.'.admin:product-basket:get-product-info.route'),              'uses' => config($config_file.'.admin:product-basket:get-product-info.controller')]);
        Route::get( config($config_file.'.admin:product-basket:set-perishable.url'),                 ['as' => config($config_file.'.admin:product-basket:set-perishable.route'),                'uses' => config($config_file.'.admin:product-basket:set-perishable.controller')]);
        Route::get( config($config_file.'.admin:product-basket:set-special.url'),                    ['as' => config($config_file.'.admin:product-basket:set-special.route'),                   'uses' => config($config_file.'.admin:product-basket:set-special.controller')]);
        Route::get( config($config_file.'.admin:product-basket:set-featured.url'),                   ['as' => config($config_file.'.admin:product-basket:set-featured.route'),                  'uses' => config($config_file.'.admin:product-basket:set-featured.controller')]);

    });

});