<?php namespace Neptrox\ProductBasket;

/**
 * This file is part of Neptrox Shopping Site,
 * a custom product basket.
 *
 * @license MIT
 * @package Neptrox/ProductBasket
 */

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class MigrationCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'neptrox-product-basket:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates migrations and run seeds if exist.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {

        $productTypeTable = Config::get(config('neptrox.product-basket-config').'.product-types-table');

        $this->line('');
        $this->info( "Seeding for table : $productTypeTable" );

        $message = "A class that inserts new row to 'BasketTypeProductSeeder' tables will be created in database/seeds directory";

        $this->comment($message);
        $this->line('');

        if ($this->confirm("Proceed with the seeding? [Yes|no]", "Yes")) {

            $this->line('');

            $this->info("Seeding in process...");
            if ($this->createSeed($productTypeTable)) {
                $this->info("Seeder class successfully created!");
                $this->call('dump-autoload');
                $this->call('db:seed --class=BasketTypeProductSeeder');
                $this->info("BasketTypeProductSeeder class successfully executed.");
            } else {
                $this->error(
                    "Couldn't create seed file.\n Check the write permissions".
                    " within the database/seeds directory."
                );
            }

            $this->line('');

        }
    }


    protected function createSeed($table)
    {
        $seedFile = base_path("/database/seeds")."/BasketTypeProductSeeder.php";

        $data = compact('table');
        $this->laravel->view->addNamespace('neptrox-product-basket', __DIR__.'/../../resources/views/');
        $output = $this->laravel->view->make('neptrox-product-basket::generators.seed')->with($data)->render();

        if (!file_exists($seedFile) && $fs = fopen($seedFile, 'x')) {
            fwrite($fs, $output);
            fclose($fs);
            return true;
        }
        return false;
    }

}
