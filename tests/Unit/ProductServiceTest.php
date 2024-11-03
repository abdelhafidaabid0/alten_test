<?php

use App\Core\Products\Product;
use App\Core\Products\ProductService;
use Illuminate\Database\Eloquent\Collection;


it('can filter products by inventory status', function () {
    session()->forget('product_filters'); // Clear previous filters


    // Apply the filter
    session(['product_filters.statut' => ProductService::INVENTORY_STATUS_INSTOCK]);

    // Run the query
    $products = ProductService::get_products_list();

    $count = Product::whereInventoryStatus(ProductService::INVENTORY_STATUS_INSTOCK)->count();

    // Check that only one product is returned and matches the status
    expect($products->total())
        ->toBe($count)
        ->and($products->first()->inventory_status)
        ->toBe(ProductService::INVENTORY_STATUS_INSTOCK);
});



it('calculates total price with specific quantities', function () {
    $product1 = Product::factory()
                       ->create(['price' => 50.0]);
    $product2 = Product::factory()
                       ->create(['price' => 30.0]);
    $products = new Collection([$product1, $product2]);

    $quantities = [
        $product1->id => 2,
        $product2->id => 3,
    ];

    $totalPrice = ProductService::get_total_prix($products, $quantities);
    expect($totalPrice)->toBe(190.0); // (50*2) + (30*3)
});

it('retrieves inventory status labels for select options', function () {
    $statusLabels = ProductService::get_products_status_pour_select();

    expect($statusLabels)->toBe([
                                    ProductService::INVENTORY_STATUS_INSTOCK    => "En stock",
                                    ProductService::INVENTORY_STATUS_LOWSTOCK   => "Stock faible",
                                    ProductService::INVENTORY_STATUS_OUTOFSTOCK => "Stock indisponible",
                                ]);
});

it('retrieves product category labels for select options', function () {
    $categoryLabels = ProductService::get_products_categories_pour_select();

    expect($categoryLabels)->toBe([
                                      ProductService::PRODUCT_WATCHS    => "Montres",
                                      ProductService::PRODUCT_FURNITURE => "Fournitures",
                                      ProductService::PRODUCT_SHOE      => "Chaussures",
                                  ]);
});

it('retrieves rating options for select', function () {
    $ratingOptions = ProductService::get_products_ratings_pour_select();

    expect($ratingOptions)->toBe([
                                     1 => "1 étoile et plus",
                                     2 => "2 étoiles et plus",
                                     3 => "3 étoiles et plus",
                                     4 => "4 étoiles et plus",
                                 ]);
});
