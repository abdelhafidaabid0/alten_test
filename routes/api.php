<?php

use App\Core\Products\ProductApiController;
use Illuminate\Support\Facades\Route;

Route::apiResource('products', ProductApiController::class);

