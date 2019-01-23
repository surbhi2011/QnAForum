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

    dd('nsjdkank');
    //Route::post('/logout', 'AuthController@logout');

    //Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/','AuthController@getAllUsers');
    //user
//    Route::namespace('user')->group(function(){
//        Route::get('/','AuthController@getAllUsers');
//        Route::get('/get/{id}','AuthController@getUser');
//        Route::patch('/{id}', 'AuthController@update');
//    });

    //return $request->user();
});

Route::post('/register','AuthController@register');

Route::post('/login', 'AuthController@login')->name('login');

