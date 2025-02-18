<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

// API routes
Route::prefix('api')->group(function () {
    Route::get('/customers', [CustomerController::class, 'getCustomers']);
    Route::post('/customers', [CustomerController::class, 'store']);
    Route::get('/customers/{customer}', [CustomerController::class, 'show']);
    Route::put('/customers/{customer}', [CustomerController::class, 'update']);
    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy']);
});

// Serve Vue.js application for frontend routes
Route::view('/{any}', 'welcome')->where('any', '.*');
