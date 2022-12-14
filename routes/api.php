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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', 'App\Http\Controllers\Api\ProductApiController@index')->name("api.product.index");
Route::get('/products/paginate', 'App\Http\Controllers\Api\ProductApiController@paginate')->name("api.product.paginate");

Route::get('/weather', 'App\Http\Controllers\Api\WeatherApiController@index')->name('api.index');
Route::get('/weather/search', 'App\Http\Controllers\Api\WeatherApiController@search')->name('api.search');