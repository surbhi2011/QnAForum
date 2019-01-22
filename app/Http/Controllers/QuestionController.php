<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function view()
    {
        // get current logged in user
        $user = Auth::user();

        // load question
        $question = Question::find(1);

        if ($user->can('view', $question)) {
            echo "Current logged in user is allowed to update the Question: {$question->id}";
        } else {
            echo 'Not Authorized.';
        }
    }

    public function create()
    {
        // get current logged in user
        $user = Auth::user();

        if ($user->can('create', Question::class)) {
            echo 'Current logged in user is allowed to create new questions.';
        } else {
            echo 'Not Authorized';
        }

        exit;
    }

    public function update()
    {
        // get current logged in user
        $user = Auth::user();

        // load question
        $question = Question::find(1);

        if ($user->can('update', $question)) {
            echo "Current logged in user is allowed to update the Question: {$question->id}";
        } else {
            echo 'Not Authorized.';
        }
    }

    public function delete()
    {
        // get current logged in user
        $user = Auth::user();

        // load question
        $question = Question::find(1);

        if ($user->can('delete', $question)) {
            echo "Current logged in user is allowed to delete the Question: {$question->id}";
        } else {
            echo 'Not Authorized.';
        }
    }
}
