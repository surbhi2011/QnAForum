<?php

namespace App\Providers;

use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Category\EloquentCategory;
use App\Repositories\Answer\AnswerRepository;
use App\Repositories\Answer\EloquentAnswer;
use App\Repositories\Question\QuestionRepositoryInterface;
use App\Repositories\User\EloquentUser;
use App\Repositories\User\UserRepository;
use App\Repositories\Question\EloquentQuestion;
use App\Repositories\Vote\EloquentVote;
use App\Repositories\Vote\VoteRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepository::class, EloquentUser::class);
        $this->app->singleton(CategoryRepositoryInterface::class, EloquentCategory::class);
        $this->app->singleton(QuestionRepositoryInterface::class, EloquentQuestion::class);
        $this->app->singleton(AnswerRepository::class, EloquentAnswer::class);
        $this->app->singleton(VoteRepository::class, EloquentVote::class);
    }
}
