<?php

use App\Core\Products\Product;
use App\Core\Products\ProductService;
use Illuminate\Http\Response;

it('can create a product', function () {
    $data = [
        'name'             => 'Produit Test',
        'code'             => 'qs65d4qs',
        'description'      => 'Description du produit test',
        'price'            => 100.0,
        'quantity'         => 10,
        'category'         => ProductService::PRODUCT_WATCHS,
        'inventory_status' => ProductService::INVENTORY_STATUS_INSTOCK,
    ];


    $response = $this->postJson('/api/products', $data);

    $response->assertStatus(Response::HTTP_CREATED)
             ->assertJsonFragment(['name' => 'Produit Test']);
});

it('can retrieve a product by ID', function () {
    $product = Product::factory()
                      ->create();

    $response = $this->getJson("/api/products/{$product->id}");

    $response->assertStatus(Response::HTTP_OK)
             ->assertJsonFragment(['name' => $product->name]);
});

it('can update a product', function () {
    $product = Product::factory()
                      ->create();
    $data    = ['name' => 'Produit Mis à Jour'];

    $response = $this->patchJson("/api/products/{$product->id}", $data);

    $response->assertStatus(Response::HTTP_OK)
             ->assertJsonFragment(['name' => 'Produit Mis à Jour']);
    $this->assertDatabaseHas('products', ['id' => $product->id, 'name' => 'Produit Mis à Jour']);
});

it('can delete a product', function () {
    $product = Product::factory()
                      ->create();

    $response = $this->deleteJson("/api/products/{$product->id}");

    $response->assertStatus(Response::HTTP_NO_CONTENT);
    $this->assertSoftDeleted('products', ['id' => $product->id]);
});

it('returns 404 for a non-existent product', function () {
    $response = $this->getJson('/api/products/9999');
    $response->assertStatus(Response::HTTP_NOT_FOUND);
});
