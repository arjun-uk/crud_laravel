<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [UserController::class,"login"])->name('login');
Route::get('/home', [UserController::class, 'home'])->name('home');
Route::get('/register', [UserController::class,"register"])->name('register');
Route::get('/logout', [UserController::class,"logout"])->name('logout');
Route::get('/add_products', [UserController::class,"add_products"])->name('add_products');
Route::get('/editProductShow/{id}', [ProductsController::class,"editProductShow"])->name('editProductShow');
Route::get('/deleteProductShow/{id}', [ProductsController::class,"deleteProductSHow"])->name('deleteProductShow');


Route::post('/submitReg', [UserController::class,"subbmitRegister"])->name('submitRegister');
Route::post('/checkLogin', [UserController::class,"checkLogin"])->name('checkLogin');
Route::post('/add_products_submit', [UserController::class,"add_products_submit"])->name('add_products_submit');
Route::post('/editProduct', [ProductsController::class,"update"])->name('editProduct');
Route::post('/deleteProduct', [ProductsController::class,"deleteProduct"])->name('deleteProduct');
Route::delete('/destroy', [ProductsController::class, 'destroy'])->name('destroy');


