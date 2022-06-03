<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/products', ProductController::class);
Route::apiResource('/categories', CategoryController::class);
Route::apiResource('/orders', OrderController::class);

//Routes for products of an order
Route::controller(OrderController::class)->prefix('orders')->group( function () {
    Route::post('/{order}/products', 'addProduct');
    Route::delete('/{order}/products/{product_id}', 'removeProduct');
    Route::put('/{order}/products/{product_id}', 'updateProduct');
});
