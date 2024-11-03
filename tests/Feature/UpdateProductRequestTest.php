<?php

use App\Core\Products\Product;
use App\Core\Products\UpdateProductRequest;
use Illuminate\Support\Facades\Validator;


it('validates update product request with optional fields', function () {
    $product = Product::factory()
                      ->create();

    $data = [
        'name'               => 'Updated Product Name',
        'price'              => 200.0,
        'quantity'           => 15,
        'category'           => 'Chaussures',
        'inventory_status'   => 'LOWSTOCK',
        'description'        => 'Updated description',
        'image'              => 'https://example.com/new-image.jpg',
        'internal_reference' => 'REF002',
        'rating'             => 5,
    ];

    $validator = Validator::make($data, (new UpdateProductRequest())->rules());
    expect($validator->passes())->toBeTrue();
});

it('fails when update product request has invalid data', function () {
    $data = [
        'price'  => "adada",
        'rating' => "6",
    ];

    $validator = Validator::make($data, (new UpdateProductRequest())->rules());
    expect($validator->fails())
        ->toBeTrue()
        ->and($validator->errors()
                        ->has('price'))
        ->toBeTrue()
        ->and($validator->errors()
                        ->has('rating'))
        ->toBeTrue();
});
