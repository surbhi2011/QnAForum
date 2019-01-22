<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function view()
    {
        // get current logged in user
        $user = Auth::user();

        // load vote
        $vote = Vote::find(1);

        if ($user->can('view', $vote)) {
            echo "Current logged in user is allowed to update the Vote: {$vote->id}";
        } else {
            echo 'Not Authorized.';
        }
    }

    public function create()
    {
        // get current logged in user
        $user = Auth::user();

        if ($user->can('create', Vote::class)) {
            echo 'Current logged in user is allowed to create new votes.';
        } else {
            echo 'Not Authorized';
        }

        exit;
    }

    public function update()
    {
        // get current logged in user
        $user = Auth::user();

        // load vote
        $vote = Vote::find(1);

        if ($user->can('update', $vote)) {
            echo "Current logged in user is allowed to update the Vote: {$vote->id}";
        } else {
            echo 'Not Authorized.';
        }
    }

    public function delete()
    {
        // get current logged in user
        $user = Auth::user();

        // load vote
        $vote = Vote::find(1);

        if ($user->can('delete', $vote)) {
            echo "Current logged in user is allowed to delete the Vote: {$vote->id}";
        } else {
            echo 'Not Authorized.';
        }
    }
}
