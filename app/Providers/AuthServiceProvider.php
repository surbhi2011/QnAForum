<?php

namespace App\Providers;

use App\Answer;
use App\Category;
use App\Policies\AnswerPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\QuestionPolicy;
use App\Policies\VotePolicy;
use App\Question;
use App\Vote;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        //'App\Question' => 'App\Policies\QuestionPolicy',
        Question::class => QuestionPolicy::class,
        Answer::class => AnswerPolicy::class,
        Vote::class => VotePolicy::class,
        Category::class => CategoryPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
