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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('expire-report','Api\UserController@expireReport')->name('expire-report');
Route::post('user-store','Api\UserController@store')->name('user-store');
Route::post('login','Api\AuthController@login')->name('login');
Route::post('logout','Api\AuthController@logout')->name('logout');
Route::get('product','Api\PurcHaseController@index')->name('product')->middleware('auth:api');


