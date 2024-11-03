<?php

use App\Core\Products\StoreProductRequest;
use Illuminate\Support\Facades\Validator;

it('validates store product request', function () {
    $data = [
        'name'               => 'Produit Test',
        'code'               => "dadza687465",
        'price'              => 100.0,
        'quantity'           => 10,
        'category'           => 'Montres',
        'inventory_status'   => 'INSTOCK',
        'description'        => 'Description de produit',
        'image'              => 'https://example.com/image.jpg',
        'internal_reference' => 'REF001',
        'rating'             => 4,
    ];

    $validator = Validator::make($data, (new StoreProductRequest())->rules());
    expect($validator->passes())->toBeTrue();
});

it('fails when store product request is missing required fields', function () {
    $data = [
        'price'    => 100.0,
        'quantity' => 10,
        'category' => 'Montres',
    ];

    $validator = Validator::make($data, (new StoreProductRequest())->rules());

    expect($validator->fails())
        ->toBeTrue()
        ->and($validator->errors()
                        ->has('name'))
        ->toBeTrue()
        ->and($validator->errors()
                        ->has('inventory_status'))
        ->toBeTrue();
});
