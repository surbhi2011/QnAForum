<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function view()
    {
        // get current logged in user
        $user = Auth::user();

        // load answer
        $answer = Answer::find(1);

        if ($user->can('view', $answer)) {
            echo "Current logged in user is allowed to update the Answer: {$answer->id}";
        } else {
            echo 'Not Authorized.';
        }
    }

    public function create()
    {
        // get current logged in user
        $user = Auth::user();

        if ($user->can('create', Answer::class)) {
            echo 'Current logged in user is allowed to create new answers.';
        } else {
            echo 'Not Authorized';
        }

        exit;
    }

    public function update()
    {
        // get current logged in user
        $user = Auth::user();

        // load answer
        $answer = Answer::find(1);

        if ($user->can('update', $answer)) {
            echo "Current logged in user is allowed to update the Answer: {$answer->id}";
        } else {
            echo 'Not Authorized.';
        }
    }

    public function delete()
    {
        // get current logged in user
        $user = Auth::user();

        // load answer
        $answer = Answer::find(1);

        if ($user->can('delete', $answer)) {
            echo "Current logged in user is allowed to delete the Answer: {$answer->id}";
        } else {
            echo 'Not Authorized.';
        }
    }
}
