<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//api routes

Route::post('/login_api', [ApiController::class, "login_api"])->name('login_api');
Route::post('/register_api', [ApiController::class, "register_api"])->name('register_api');
Route::post('/send_firebase_notification', [ApiController::class, 'send_firebase_notification'])->name('send_firebase_notification');

    

Route::middleware('custom.token')->group(function () {
    Route::post('/products', [ApiController::class, 'get_products'])->name('get_products');
    Route::post('/add_product', [ApiController::class, 'add_product'])->name('add_product');
    Route::post('/change_password', [ApiController::class, 'change_password'])->name('change_password');
    Route::post('/get_profile', [ApiController::class, 'get_profile'])->name('get_profile');
    Route::post('/get_all_users', [ApiController::class, 'get_all_users'])->name('get_all_users');
});


