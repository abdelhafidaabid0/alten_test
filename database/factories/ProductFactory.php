<?php

namespace Database\Factories;

use App\Core\Products\Product;
use App\Core\Products\ProductService;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

// Chemin mis à jour du modèle Product

class ProductFactory extends Factory {
    // Associe le modèle Product à cette factory
    protected $model = Product::class;



    /**
     * Définit les valeurs par défaut pour les attributs du modèle.
     *
     * @return array
     */
    public function definition() {
        $inventory_status = $this->faker->randomElement(ProductService::INVENTORY_STATUS);


        switch ($inventory_status) {
            case ProductService::INVENTORY_STATUS_INSTOCK:
                $quantity = $this->faker->numberBetween(50, 100);
                break;
            case ProductService::INVENTORY_STATUS_LOWSTOCK:
                $quantity = $this->faker->numberBetween(5, 20);
                break;
            default:
                $quantity = 0;
        }

        $category = $this->faker->randomElement(ProductService::PRODUCT_CATEGORIES);

        return [
            'code'               => Str::random(10),
            'name'               => $this->faker->name,
            'description'        => $this->faker->sentence,
            'image'              => "https://via.assets.so/$category.png?id=" . $this->faker->numberBetween(1, 300) . "&q=95&w=360&h=360&fit=contain",
            'category'           => ucfirst($category),
            'price'              => $this->faker->randomFloat(2, 10, 500),
            'quantity'           => $quantity,
            'internal_reference' => Str::random(8),
            'shell_id'           => Str::random(8),
            'inventory_status'   => $inventory_status,
            'rating'             => $this->faker->numberBetween(1, 5),
        ];
    }
}
