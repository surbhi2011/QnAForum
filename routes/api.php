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

    Route::prefix('question')->group(function (){

//        Route::view('/askquestion','askquestion');

        Route::post('/askquestion','QuestionController@store');

        Route::post('/updatequestion/{id}','QuestionController@updatequestion');

        Route::get('question/{id}','QuestionController@getQuestionById');

        Route::get('userallquestions/{id}','QuestionController@showAllUserQuestions');

        Route::get('categoryallquestions/{category}','QuestionController@showAllCategoryQuestions');

        Route::get('allquestions','QuestionController@show');

        Route::get('deletequestion/{id}','QuestionController@destroy');

        Route::get('questionoldestfirst','QuestionController@showQuestionsOldestFirst');
    });

});
