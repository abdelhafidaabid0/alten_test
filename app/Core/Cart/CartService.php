<?php

namespace App\Core\Cart;

use App\Core\Products\Product;
use Illuminate\Support\Arr;

class CartService {
    public static function get_cart_info() : array {
        // Retrieve the cart from the session, or initialize an empty array if it doesn't exist
        $cart_session = session('cart', []);
        $cart_info    = [
            'products'         => [],
            'quantities'       => [],
            'total_quantities' => 0,
            'total_price'      => 0,
        ];

        if (empty($cart_session)) {
            return $cart_info;
        }

        $selected_products = $cart_session["selected_products"] ?? [];

        $products_ids = array_keys($selected_products);

        $products = Product::whereIn('id', $products_ids)
                           ->get();
        // calculate the total for the cart and save it to the session
        $total_price = array_reduce($products->toArray(), function ($sum, $product) use ($selected_products) {
            $product_total_price = $product["price"] * $selected_products[$product["id"]];

            return $sum + $product_total_price;
        },                          0);

        $total_quantities = array_reduce($selected_products, function ($sum, $item) {
            return $sum + $item;
        },                               0);

        return [
            'products'         => $products,
            'quantities'       => $selected_products,
            'total_quantities' => $total_quantities,
            'total_price'      => round($total_price, 2),
        ];
    }



    public static function add_to_cart($product, mixed $quantity) : void {
        // Retrieve the cart from the session or initialize an empty array
        $cart = session('cart', []);

        // Check if the product is already in the cart
        if (isset($cart["selected_products"][$product->id])) {
            // If product already exists, increment the quantity
            $cart["selected_products"][$product->id] += $quantity;
        } else {
            // If product does not exist, add it to the cart with the given quantity
            $cart["selected_products"][$product->id] = $quantity;
        }

        session()?->put('cart', $cart);
    }



    public static function update_cart_product_quantity(Product $product, int $quantity) : void {
        // Retrieve the cart from the session or initialize an empty array
        $cart = session('cart', []);

        // Check if the product is already in the cart
        if (isset($cart["selected_products"][$product->id])) {
            // If product already exists, increment the quantity
            $cart["selected_products"][$product->id] = $quantity;

            session()?->put('cart', $cart);
        }
    }



    public static function remove_from_cart(int $product_id) : void {
        $cart_session = session()?->pull('cart', []);

        $selected_products = $cart_session["selected_products"] ?? [];

        $selected_products = Arr::except($selected_products, [$product_id]);

        $cart_session["selected_products"] = $selected_products;

        session()?->put('cart', $cart_session);
    }

}