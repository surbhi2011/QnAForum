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

    Route::prefix('question')->group(function (){
      //Route::view('ask','askquestion');
        Route::post('ask','QuestionController@store');
        Route::patch('update/{id}','QuestionController@updatequestion');
        Route::get('{id}','QuestionController@getQuestionById');
        Route::get('user/{id}','QuestionController@showAllUserQuestions');
        Route::get('category/{category}','QuestionController@showAllCategoryQuestions');
        Route::get('all','QuestionController@show');
        Route::delete('delete/{id}','QuestionController@destroy');
        Route::get('old','QuestionController@showQuestionsOldestFirst');
        Route::get('count','QuestionController@getCount');
        Route::get('upvote/{id}','QuestionController@upvote');
        Route::get('downvote/{id}','QuestionController@downvote');
    });

    Route::prefix('category')->group(function () {
        Route::get('{id}','CategoryController@getCategoryById');
        Route::post('create','CategoryController@store');
        Route::patch('update/{id}','CategoryController@updatecategory');
        Route::delete('delete/{id}','CategoryController@destroy');
    });

    Route::prefix('user')->group(function (){
        Route::get('/','UserController@getAllUsers');
        Route::get('/{id}', 'UserController@getuser');
        Route::patch('/{id}','UserController@update');
        Route::delete('/{id}','UserController@delete');
    });


    Route::prefix('answer')->group(function (){
        Route::get('/ans', 'AnswerController@getUserAnswers');
        Route::get('/{id}/count','AnswerController@getCount');
        Route::get('/', 'AnswerController@getAllAnswers');
        Route::get('/{id}','AnswerController@getAnswer');
        Route::get('/{qid}/question','AnswerController@getAnswerByQuestion');
        Route::post('/{qid}', 'AnswerController@store');
        Route::patch('/{id}','AnswerController@update');
        Route::delete('/{id}/question','AnswerController@deleteAnswer');
        Route::delete('/{id}','AnswerController@delete');
        Route::post('/upvote/{id}','AnswerController@upVote');
        Route::post('/downvote/{id}','AnswerController@downVote');
    });

    Route::prefix('role')->group(function ()
    {
       Route::post('create','RoleController@store');
       Route::patch('update/{id}','RoleController@updaterole');
       Route::delete('delete/{id}','RoleController@destroy');
    });

    Route::prefix('userroles')->group(function()
    {
       Route::post('create','UserRolesController@store');
       Route::delete('delete/{user_id}/{role_id}','UserRolesController@destroy');
    });

    Route::prefix('vote')->group(function (){
        Route::get('/user','VoteController@getUser');
        Route::get('/qupvote/{id}', 'VoteController@getQuestionUpvotes');
        Route::get('/qdownvote/{id}', 'VoteController@getQuestionDownvotes');
        Route::get('/aupvote/{id}', 'VoteController@getAnswerUpvotes');
        Route::get('/adownvote/{id}', 'VoteController@getAnswerDownvotes');
        Route::post('/add', 'VoteController@store');
        Route::delete('/', 'VoteController@getdelete');
    });
});
