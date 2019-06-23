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


Route::get('products','ProductController@all');
Route::get('products/{id}','ProductController@getProduct');
Route::post('products/create','ProductController@createProduct');
Route::delete('products/{id}','ProductController@deleteProduct');
