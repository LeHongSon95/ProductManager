<?php

use App\Http\Controllers\API\ProductAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CustomersController;
use App\Http\Controllers\API\OrderController;

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

Route::post('register', [CustomersController::class, 'register']);
Route::post('login', [CustomersController::class, 'login']);



Route::middleware('auth:api')->group(function () {
    Route::post('infoLogin', [CustomersController::class, 'infomation']);
    Route::post('update', [CustomersController::class, 'update']);
    
    Route::get('products', [ProductAPIController::class, 'index']);
    Route::get('products/{id}', [ProductAPIController::class, 'show']);
    Route::post('order', [OrderController::class, 'order'])->name('add.to.cart');
});
