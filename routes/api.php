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
        Route::post('ask/{id}','QuestionController@store')->middleware('can:create,$id');
        Route::patch('update/{id}','QuestionController@updatequestion')->middleware('can:update,id');
        Route::get('list/{id}','QuestionController@getQuestionList');
        Route::get('user/{id}','QuestionController@showAllUserQuestions');
        Route::get('category/{category}','QuestionController@showAllCategoryQuestions');
        Route::get('/all','QuestionController@show');
        Route::delete('delete/{id}','QuestionController@destroy');
        Route::get('old','QuestionController@showQuestionsOldestFirst');
        Route::get('count','QuestionController@getCount');
        Route::post('upvote/{id}','QuestionController@upvote');
        Route::post('downvote/{id}','QuestionController@downvote');
        Route::get('{id}','QuestionController@getQuestionById');

    });

    Route::prefix('category')->group(function () {
        Route::post('create','CategoryController@store');
        Route::patch('update/{id}','CategoryController@updatecategory')->middleware('can:update,id');
        Route::delete('delete/{id}','CategoryController@destroy');
        Route::get('{id}','CategoryController@getCategoryById');
    });

    Route::prefix('user')->group(function (){
        Route::get('/count', 'UserController@getCount');
        Route::get('/','UserController@getAllUsers');
        Route::get('/{id}', 'UserController@getuser');
        Route::patch('/{id}','UserController@update')->middleware('can:update,id');
        Route::delete('/{id}','UserController@delete');
    });


    Route::prefix('answer')->group(function (){
        Route::get('/ans', 'AnswerController@getUserAnswers');
        Route::get('/{id}/count','AnswerController@getCount');
        Route::get('/', 'AnswerController@getAllAnswers')->middleware('can:view,App\Answer');
        Route::get('/{qid}/question','AnswerController@getAnswerByQuestion');
        Route::post('/{id}', 'AnswerController@store')->middleware('can:create,id');
        Route::patch('/{id}','AnswerController@update')->middleware('can:update, id');
        //Route::delete('/{id}/question','AnswerController@deleteAnswer');
        Route::delete('/{id}','AnswerController@delete');
        Route::post('/upvote/{id}','AnswerController@upVote');
        Route::post('/downvote/{id}','AnswerController@downVote');
        Route::get('/{id}','AnswerController@getAnswer');

    });

    Route::prefix('role')->group(function ()
    {
       Route::post('create','RoleController@store');
       Route::patch('update/{id}','RoleController@updaterole')->middleware('can:update,id');
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
        Route::delete('/{id}', 'VoteController@delete');
    });
});
