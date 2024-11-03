<?php

use App\Core\Cart\CartController;
use App\Core\Contacts\ContactController;
use App\Core\Products\ProductController;
use Illuminate\Support\Facades\Route;

// Route pour la page d'accueil
Route::get('/', [ProductController::class, 'show_all_products'])
     ->name('home');

// Route pour le formulaire de contact
Route::get('/contact', [ContactController::class, 'index'])
     ->name('contact');


Route::post('/contact', [ContactController::class, 'send_message'])
     ->name('contact.send_message');

Route::get('/cart', [CartController::class, 'get_cart'])
     ->name('cart');

Route::post('/add_to_cart/{product_id}/{quantity}', [CartController::class, 'add_to_cart'])
     ->name('cart.add_to_cart');

Route::post('/update_cart_product_quantity/{product_id}/{quantity}', [CartController::class, 'update_cart_product_quantity'])
     ->name('cart.update_cart_product_quantity');

Route::post('/remove_from_cart/{product_id}', [CartController::class, 'remove_from_cart'])
     ->name('cart.remove_from_cart');
