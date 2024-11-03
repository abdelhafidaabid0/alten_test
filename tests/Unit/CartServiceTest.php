<?php

use App\Core\Cart\CartService;
use App\Core\Products\Product;
use Illuminate\Support\Facades\Session;

beforeEach(function () {
    Session::start();
});

it('can add an item to the cart', function () {
    $product = Product::factory()->create(['price' => 50.0]);

    CartService::add_to_cart($product, 2);

    $cartInfo = CartService::get_cart_info();
    expect($cartInfo['total_quantities'])->toBe(2)
                                         ->and($cartInfo['total_price'])->toBe(100.0);
});

it('can remove an item from the cart', function () {
    $product = Product::factory()->create(['price' => 50.0]);

    CartService::add_to_cart($product, 2);
    CartService::remove_from_cart($product->id);

    $cartInfo = CartService::get_cart_info();
    expect($cartInfo['total_quantities'])->toBe(0)
                                         ->and($cartInfo['total_price'])->toBe(0.0);
});

it('calculates total quantity and price correctly', function () {
    $product1 = Product::factory()->create(['price' => 30.0]);
    $product2 = Product::factory()->create(['price' => 20.0]);

    CartService::add_to_cart($product1, 3);
    CartService::add_to_cart($product2, 2);

    $cartInfo = CartService::get_cart_info();
    expect($cartInfo['total_quantities'])->toBe(5)
                                         ->and($cartInfo['total_price'])->toBe(130.0);
});
