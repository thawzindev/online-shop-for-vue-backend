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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//products route
Route::get('products', 'Api\ProductController@index');
Route::get('feature-products', 'Api\ProductController@featureProducts');
Route::get('product/{uuid}', 'Api\ProductController@find');
Route::get('product/{id}/check', 'Api\ProductController@checkProduct');

//category route
Route::get('categories', 'Api\CategoryController@index');
Route::get('category/{uuid}', 'Api\CategoryController@find');

Route::get('category/{id}/all-products', 'Api\ProductController@getAllProducts');

Route::post('checkout', 'Api\CheckOutController@index');

//blog route
Route::get('blogs', 'Api\BlogController@index');
Route::get('feature-blogs', 'Api\BlogController@getFeatureBlog');

