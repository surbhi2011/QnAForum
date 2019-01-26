<?php

namespace App\Policies;

use App\Answer;
use App\Question;
use App\User;
use App\Vote;
use Illuminate\Auth\Access\HandlesAuthorization;

class VotePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the vote.
     *
     * @param  \App\User  $user
     * @param  \App\Vote  $vote
     * @return mixed
     */
    public function view(User $user, Vote $vote)
    {
        return TRUE;
    }

    /**
     * Determine whether the user can create votes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function createQue(User $user,Vote $vote,Question $question)
    {
        return $user->id !== $question->user_id;
    }

    public function createAns(User $user,Vote $vote,Answer $answer)
    {
        return $user->id !== $answer->user_id;
    }
    /**
     * Determine whether the user can update the vote.
     *
     * @param  \App\User  $user
     * @param  \App\Vote  $vote
     * @return mixed
     */
//    public function update(User $user, Vote $vote)
//    {
//        if($user->id === $vote->user_id)
//            return FALSE;
//        else
//            return TRUE;
//    }

    /**
     * Determine whether the user can delete the vote.
     *
     * @param  \App\User  $user
     * @param  \App\Vote  $vote
     * @return mixed
     */
    public function delete(User $user, Vote $vote)
    {
        return $user->id === $vote->user_id;
    }

    /**
     * Determine whether the user can restore the vote.
     *
     * @param  \App\User  $user
     * @param  \App\Vote  $vote
     * @return mixed
     */
    public function restore(User $user, Vote $vote)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the vote.
     *
     * @param  \App\User  $user
     * @param  \App\Vote  $vote
     * @return mixed
     */
    public function forceDelete(User $user, Vote $vote)
    {
        //
    }
}
