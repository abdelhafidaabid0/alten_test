<?php

namespace App\Core\Products;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'image',
        'category',
        'price',
        'quantity',
        'internal_reference',
        'inventory_status',
        'rating',
    ];





    /**
     * Spécifie la factory associée au modèle Product
     *
     * @return Factory
     */
    protected static function newFactory() {
        return ProductFactory::new();
    }
}