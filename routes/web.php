<?php

use App\Core\Contacts\ContactController;
use App\Core\Products\ProductController;
use Illuminate\Support\Facades\Route;

// Route pour la page d'accueil
Route::get('/', [ProductController::class, 'index'])
     ->name('home');
// Autres routes pour les produits
Route::resource('products', ProductController::class)
     ->names([
                 'create'  => 'products.create',
                 'store'   => 'products.store',
                 'show'    => 'products.show',
                 'edit'    => 'products.edit',
                 'update'  => 'products.update',
                 'destroy' => 'products.destroy',
             ])
     ->except(['index']);

// Route pour le formulaire de contact
Route::get('/contact', [ContactController::class, 'index'])
     ->name('contact');
Route::post('contact', [ContactController::class, 'send_message'])
     ->name('contact.send_message');
