<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//api routes

Route::post('/login_api', [ApiController::class,"login_api"])->name('login_api');
Route::post('/register_api', [ApiController::class,"register_api"])->name('register_api');

Route::middleware('custom.token')->group(function () {
    Route::post('/products', [ApiController::class, 'get_products'])->name('get_products');
    Route::post('/add_product',[ApiController::class, 'add_product'])->name('add_product');
});
