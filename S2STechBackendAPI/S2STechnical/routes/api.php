<?php

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

// Base url
Route::get('/', function () {
    return "Hello World!";
});


// Url for fetching products
Route::get('/products', [App\Http\Controllers\ProductController::class, 'read']);

// Url for creating products
Route::post('/products', [App\Http\Controllers\ProductController::class, 'create']);
