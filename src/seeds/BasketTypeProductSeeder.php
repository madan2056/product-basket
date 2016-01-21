<?php
namespace Neptrox\ProductBasket;

use Illuminate\Database\Seeder;
use DB;

class BasketTypeProductSeeder extends Seeder
{
    public function run()
    {
        $table = config(config('neptrox.product-basket-config').'.product-types-table');

        if (DB::table($table)->where('url', 'product-basket')->count() == 0) {
            DB::table($table)->insert([
                'name' => 'Product Basket',
                'url' => 'product-basket',
                'status' => 1,
            ]);
        }
    }
}