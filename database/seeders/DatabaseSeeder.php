<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // ## Seeders ejecutan lo que definimos en los Factories 
        // \App\Models\User::factory(10)->create();
        $products = Product::factory(50)->create();
    }
}
