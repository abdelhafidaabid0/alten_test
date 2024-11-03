<?php

use App\Core\Products\Product;

it('can add a product to the cart', function () {
    $product = Product::factory()
                      ->create(['quantity' => 20]);

    $response = $this->post(route('cart.add_to_cart', ['product_id' => $product->id, 'quantity' => 2]));

    $response->assertRedirect()
             ->assertSessionHas('notification_messages', [
                 ['message' => "2 produits $product->name ajouté au panier avec succès.", 'type' => 'success'],
             ]);
});

it('can remove a product from the cart', function () {
    $product = Product::factory()
                      ->create();

    $this->post(route('cart.add_to_cart', ['product_id' => $product->id, 'quantity' => 1]));
    $response = $this->post(route('cart.remove_from_cart', ['product_id' => $product->id]));

    $response->assertRedirect()
             ->assertSessionHas('notification_messages', [
                 ['message' => "Produit supprimé du panier avec succès.", 'type' => 'success'],
             ]);
});

it('returns error when adding non-existent product to cart', function () {
    $response = $this->post(route('cart.add_to_cart', ['product_id' => 9999, 'quantity' => 1]));

    $response->assertRedirect()
             ->assertSessionHas('notification_messages', [
                 ['message' => 'Produit non trouvé !.', 'type' => 'error'],
             ]);
});
