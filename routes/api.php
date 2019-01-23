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

Route::post('/register','AuthController@register');

Route::post('/login', 'AuthController@login')->name('login');

//Route::get('/user','AuthController@getAllUsers');

Route::group(['middleware' => ['jwt.auth']], function (){
    Route::get('user','AuthController@getAllUsers');

    Route::get('question', function (){
        //dd('dmkdkm');
        //Route::get('/{id}','QuestionController@getQuestionById');
        //Route::view('/askquestion','askquestion');
        //Route::get('question/{id}','QuestionController@getQuestionById');
        Route::get('/','QuestionController@getAllQuestions');
        //Route::post('/askquestion','QuestionController@store');
    });


});