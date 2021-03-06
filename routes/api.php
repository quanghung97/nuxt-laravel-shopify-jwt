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

Route::get('/get-access-token-shopify', 'Auth\GetTokenController@getToken')->middleware('web');

Route::post('login', 'API\AuthController@login');
Route::middleware('jwt.auth')->group(function () {
    Route::get('logout', 'API\AuthController@logout');
    Route::get('user-info', 'API\AuthController@getUserInfo');
    Route::get('products', 'API\Product\ProductController@index');
    Route::get('themes', 'API\Theme\ThemeController@index');
});
