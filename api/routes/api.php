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

Route::group(['middleware' => 'auth:api'], function () {
    
    /*
    |---------------------------------------------------------------------------
    | Cart
    |---------------------------------------------------------------------------
    */

    Route::get('/cart',[\App\Http\Controllers\CartController::class,'get']);
    Route::post('/cart',[\App\Http\Controllers\CartController::class,'add']);
    Route::put('/cart',[\App\Http\Controllers\CartController::class,'update']);
    Route::delete('/cart/{id}',[\App\Http\Controllers\CartController::class,'delete']);

    /*
    |---------------------------------------------------------------------------
    | Orders
    |---------------------------------------------------------------------------
    */

    Route::get('/orders',[\App\Http\Controllers\OrderController::class,'apiIndex']);
    Route::get('/orders/{from}',[\App\Http\Controllers\OrderController::class,'apiIndex']);
    Route::post('/order/cart',[\App\Http\Controllers\OrderController::class,'orderCart']);
    Route::delete('/order/{id}',[\App\Http\Controllers\OrderController::class,'cancelOrder']);

    /*
    |---------------------------------------------------------------------------
    | Addresses
    |---------------------------------------------------------------------------
    */

    Route::get('/address',[\App\Http\Controllers\AddressController::class,'get']);
    Route::post('/address',[\App\Http\Controllers\AddressController::class,'add']);
    Route::put('/address/{id}',[\App\Http\Controllers\AddressController::class,'update']);
    Route::put('/useaddress/{id}',[\App\Http\Controllers\AddressController::class,'useAddress']);
    Route::delete('/address/{id}',[\App\Http\Controllers\AddressController::class,'delete']);
});

/*
|---------------------------------------------------------------------------
| Sliders
|---------------------------------------------------------------------------
*/

Route::get('/sliders', [\App\Http\Controllers\SliderController::class, 'get']);
Route::get('/sliders/{slug}', [\App\Http\Controllers\SliderController::class, 'get']);

/*
|---------------------------------------------------------------------------
| Tags
|---------------------------------------------------------------------------
*/

Route::get('/categories', [\App\Http\Controllers\TagController::class, 'get']);
Route::get('/tags/{category}', [\App\Http\Controllers\TagController::class, 'get']);
Route::get('/tags/{category}/{slug}', [\App\Http\Controllers\TagController::class, 'get']);

/*
|---------------------------------------------------------------------------
| Sections
|---------------------------------------------------------------------------
*/
// Route::get('/sections', [\App\Http\Controllers\SectionController::class, 'get']);
// Route::get('/sections/{slug}', [\App\Http\Controllers\SectionController::class, 'get']);

/*
|---------------------------------------------------------------------------
| Products
|---------------------------------------------------------------------------
*/

Route::get('/products', [\App\Http\Controllers\ProductController::class, 'get']);
Route::get('/products/{category}', [\App\Http\Controllers\ProductController::class, 'get']);
Route::get('/products/{category}/{subcategory}', [\App\Http\Controllers\ProductController::class, 'get']);
Route::get('/products/{category}/{subcategory}/{brand}', [\App\Http\Controllers\ProductController::class, 'get']);
Route::get('/products/{category}/{subcategory}/{brand}/{from}', [\App\Http\Controllers\ProductController::class, 'get']);
Route::get('/products/{category}/{subcategory}/{brand}/{from}/{limit}', [\App\Http\Controllers\ProductController::class, 'get']);
Route::get('/products/{category}/{subcategory}/{brand}/{from}/{limit}/{order_by}', [\App\Http\Controllers\ProductController::class, 'get']);

Route::get('/product/{id}', [\App\Http\Controllers\ProductController::class, 'product']);

/*
|---------------------------------------------------------------------------
| Login
|---------------------------------------------------------------------------
*/

Route::post('/login',[\App\Http\Controllers\UserController::class,'login']);
Route::post('/register',[\App\Http\Controllers\UserController::class,'register']);
Route::get('/unauthorize',function (){ return ['success' => false, 'code' => 100, 'text' => 'Unauthorize access.']; });
