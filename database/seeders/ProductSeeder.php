<?php

namespace Database\Seeders;

use App\Core\Products\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run() {
        // Génère 50 produits factices en utilisant la ProductFactory
        Product::factory(300)
               ->create();
    }
}
