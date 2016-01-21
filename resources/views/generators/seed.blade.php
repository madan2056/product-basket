<?php echo '<?php' ?>
use Illuminate\Database\Seeder;

class BasketTypeProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('{{ $table }}')->insert([
                'name' => 'Product Basket',
                'url' => 'product-basket',
                'status' => 1,
        ]);
    }
}