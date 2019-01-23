<?php

namespace App\Providers;

use App\Repositories\User\EloquentUser;
use App\Repositories\User\UserRepository;
use App\Repositories\Question\EloquentQuestion;
use App\Repositories\Question\QuestionRepository;
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

        $this->app->singleton(QuestionRepository::class, EloquentQuestion::class);
    }
}
