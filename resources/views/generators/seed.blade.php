<?php echo '<?php \\n' ?>
use Illuminate\Database\Seeder;

class BasketTypeProductSeeder extends Seeder
{
    public function run()
    {
        if (DB::table('{{ $table }}')->where('url', 'product-basket')->count() == 0) {
            DB::table('{{ $table }}')->insert([
                    'name' => 'Product Basket',
                    'url' => 'product-basket',
                    'status' => 1,
            ]);
        }
    }
}