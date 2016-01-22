<?php
namespace Neptrox\ProductBasket;

use Illuminate\Support\ServiceProvider;

class ProductBasketServiceProvider extends ServiceProvider
{

    protected $defer = false;
    private $config_file_name = 'neptrox-product-basket';

    public function register()
    {
        $this->mergeConfig();
    }

    public function boot()
    {
        // Merge Package Menu to Core Menu
        $configPath = __DIR__ . '/../config/neptrox-adminpanel-menu.php';
        $this->mergeAdminMenu($configPath, 'neptrox-adminpanel-menu');

        // alias for Package View and Language folder path
        // first search into laravel view's vendor folder and fall back will be package view/lang folder
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'neptrox-product-basket');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'neptrox-product-basket');

        // Publish file / files inside defined folder to certain path
        $this->publishes([
            __DIR__.'/../config/neptrox-product-basket.php' => config_path('neptrox-product-basket.php'),
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/neptrox-product-basket'),
            __DIR__.'/../resources/lang' => base_path('resources/lang/vendor/neptrox-product-basket'),
        ]);

        $this->mergeProductPageRoute();
        $this->mergeProductTypeBadge();
        $this->addConfigFileName();

        require __DIR__."/Http/routes.php";

        // Add Menu to Breadcrumbs used in Admin Panel
        if (class_exists('Breadcrumbs'))
            require __DIR__ . '/Http/breadcrumbs.php';

    }


    /**
     * Make package config available to app config scope
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/neptrox-product-basket.php', $this->config_file_name
        );
    }

    /**
     * Add Package Config file name to neptrox.php Config File
     */
    private function addConfigFileName()
    {
        $config = $this->app['config']->get('neptrox', []);
        $this->app['config']->set('neptrox', array_merge($config, [
            'product-basket-config' => $this->config_file_name
        ]));

    }

    /**
     * Merge Basket Type Product route to core config
     * "neptrox.product-page-route"
     */
    private function mergeProductPageRoute()
    {
        $key = 'neptrox.product-page-route';
        $config = $this->app['config']->get($key, []);
        $this->app['config']->set($key, array_merge($config, [
            'product-basket' => config($this->config_file_name.'.product-basket.route')
        ]));

    }

    /**
     * Merge Basket Type Product badge to core config
     * "neptrox.product-type-badge"
     */
    private function mergeProductTypeBadge()
    {
        if (config($this->config_file_name.'.show-badge')) {
            $key = 'neptrox.product-type-badge';
            $config = $this->app['config']->get($key, []);
            $this->app['config']->set($key, array_merge($config, [
                'product-basket' => config($this->config_file_name.'.badge-html')
            ]));
        }
    }

    /**
     * Merge menu array to core Admin Menu array
     *
     * @param $path Config to be merged to
     * @param $key Config Key
     */
    private function mergeAdminMenu($path, $key)
    {
        $config = $this->app['config']->get($key, []);
        $this->app['config']->set($key, array_merge_recursive($config, require $path));
    }

}