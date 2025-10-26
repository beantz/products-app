<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);
Route::get('/products/{id}', [ProductController::class, 'show']);

Route::get('/productsDetails', [ProductDetailsController::class, 'index']);
Route::post('/productsDetails/{id_product}', [ProductDetailsController::class, 'store']);
Route::delete('/productsDetails/{id_product}', [ProductDetailsController::class, 'destroy']);
Route::get('/productsDetails/{id_product}', [ProductDetailsController::class, 'show']);

Route::get('/productsReview', [ReviewController::class, 'index']);
Route::post('/productsReview/{id}', [ReviewController::class, 'store']);
Route::delete('/productsReview/{id}', [ReviewController::class, 'destroy']);