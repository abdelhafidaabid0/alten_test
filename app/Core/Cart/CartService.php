<?php

namespace App\Core\Cart;

use App\Core\Products\Product;
use App\Core\Products\ProductService;

class CartService {
    public static function get_cart_info() : array {
        $products = Product::all()
                           ->random()
                           ->take(3)
                           ->get();


        return [
            'products'   => $products,
            'nombre'     => count($products),
            'total_prix' => ProductService::get_total_prix($products),
        ];
    }
}