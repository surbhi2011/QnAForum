<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/allusers','Auth\RegisterController@getAllUsers');

Route::post('/register', 'Auth\RegisterController@create');

Route::get('/question/{id}','QuestionController@getQuestionById');

Route::view('/askquestion','askquestion');

Route::get('question/{id}','QuestionController@getQuestionById');

Route::get('allquestions','QuestionController@getAllQuestions');

Route::post('/askquestion','QuestionController@store');
