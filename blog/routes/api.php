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

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/me', 'Api\AuthController@me');
    Route::post('/logout', 'Api\AuthController@logout');

    Route::prefix('wallet')->group(function() {
      Route::get('/', 'WalletController@index');
      Route::get('/{id}', 'WalletController@detail');
      Route::post('/', 'WalletController@add');
      Route::delete('/{id}', 'WalletController@delete');
    }); 
});


Route::get('/test', 'Controller@testResponseError');