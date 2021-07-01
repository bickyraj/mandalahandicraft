<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace ('Api')->prefix('auth')->group(function () {
    Route::post('register', 'LoginController@register');
    Route::post('login', 'LoginController@login');
    Route::get('payload', 'LoginController@payload');
    Route::middleware('apiAuth')->group(function () {
        Route::post('logout', 'LoginController@logout');
        Route::post('refresh-access-token', 'LoginController@refreshAccessToken');

    });

});

Route::namespace ('Api')->group(function () {
    Route::middleware('apiAuth')->group(function () {
        // Route::get('make-favourite/{productId}', 'ProductController@makeFavourite');
        // Route::get('remove-from-favourite/{productId}', 'ProductController@removeFromFavourite');
        // Route::get('favourite-products', 'ProductController@favourite');
        Route::get('my-orders', 'CartController@myOrders');
        // Route::post('product/{product}/rate', 'ReviewController@rate');
    });
    Route::get('get-sliders', 'SliderController@index');
    Route::get('all-categories', 'CategoryController@index');
    Route::get('products', 'ProductController@products');
    Route::get('product/{product}', 'ProductController@detail');
    Route::get('category-products/{category_id}', 'CategoryController@products');
    Route::get('news', 'NewsController@index');

});
