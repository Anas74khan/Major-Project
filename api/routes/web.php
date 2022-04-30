<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth:web'], function () {

    Route::get('/', function () {
        return view(
            'pages.dashboard',
            [
                'admin' => request() -> admin,
                'breadcrumbs' => [
                    ['name' => 'Dashboard']
                ]
            ]
        );
    });
    Route::get('/dashboard',function () {
        return view(
            'pages.dashboard',
            [
                'admin' => request() -> admin,
                'breadcrumbs' => [
                    ['name' => 'Dashboard']
                ]
            ]
        );
    });
    
    Route::get('/category', [\App\Http\Controllers\TagController::class, 'categoryView']);
    Route::get('/categories', [\App\Http\Controllers\TagController::class, 'categories']);
    Route::post('/categories', [\App\Http\Controllers\TagController::class, 'add']);
    Route::put('/categories', [\App\Http\Controllers\TagController::class, 'update']);
    Route::delete('/categories/{id}', [\App\Http\Controllers\TagController::class, 'delete']);

    Route::get('/subcategory', [\App\Http\Controllers\TagController::class, 'subcategoryView']);
    Route::get('/subcategories', [\App\Http\Controllers\TagController::class, 'subcategories']);
    Route::post('/subcategories', [\App\Http\Controllers\TagController::class, 'add']);
    Route::put('/subcategories', [\App\Http\Controllers\TagController::class, 'update']);
    Route::delete('/subcategories/{id}', [\App\Http\Controllers\TagController::class, 'delete']);

    Route::get('/brand', [\App\Http\Controllers\TagController::class, 'brandView']);
    Route::get('/brands', [\App\Http\Controllers\TagController::class, 'brands']);
    Route::post('/brands', [\App\Http\Controllers\TagController::class, 'add']);
    Route::put('/brands', [\App\Http\Controllers\TagController::class, 'update']);
    Route::delete('/brands/{id}', [\App\Http\Controllers\TagController::class, 'delete']);

    Route::get('/section', [\App\Http\Controllers\SectionController::class, 'view']);
    Route::get('/sections', [\App\Http\Controllers\SectionController::class, 'index']);

    Route::get('/slider', [\App\Http\Controllers\SliderController::class, 'viewIndex']);
    Route::get('/sliders', [\App\Http\Controllers\SliderController::class, 'index']);
    Route::post('/sliders', [\App\Http\Controllers\SliderController::class, 'add']);
    Route::put('/sliders', [\App\Http\Controllers\SliderController::class, 'update']);
    Route::delete('/sliders/{id}', [\App\Http\Controllers\SliderController::class, 'delete']);

    Route::get('/product', [\App\Http\Controllers\ProductController::class, 'viewIndex']);
    Route::get('/product/{id}', [\App\Http\Controllers\ProductController::class, 'varieties']);
    Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index']);
    
    Route::post('/variety', [\App\Http\Controllers\ProductController::class, 'VarietyAdd']);
    Route::put('/variety/{id}', [\App\Http\Controllers\ProductController::class, 'VarietyEdit']);
    Route::put('/visibility/variety/{id}', [\App\Http\Controllers\ProductController::class, 'visibility']);
    Route::put('/stock/variety/{id}', [\App\Http\Controllers\ProductController::class, 'stock']);

    Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'view']);
    Route::get('/admins', [\App\Http\Controllers\AdminController::class, 'index']);
    
    Route::get('/admin/{id}', [\App\Http\Controllers\AdminController::class, 'view']);
    Route::get('/profile', [\App\Http\Controllers\AdminController::class, 'profile']);
    
    Route::get('/user', [\App\Http\Controllers\UserController::class, 'viewIndex']);
    Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);

    

    Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'view']);
    Route::get('/orders/{status}', [\App\Http\Controllers\OrderController::class, 'view']);
    Route::get('/orders/{status}/{page}', [\App\Http\Controllers\OrderController::class, 'view']);

});

/*
|---------------------------------------------------------------------------
| Login
|---------------------------------------------------------------------------
*/

Route::get('/login',[\App\Http\Controllers\Login::class, 'index']);
Route::post('/login',[\App\Http\Controllers\Login::class, 'login']);
Route::post('/logout',[\App\Http\Controllers\Login::class, 'logout']);
