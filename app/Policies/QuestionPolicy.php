<?php

namespace App\Policies;

use App\Category;
use App\User;
use App\Question;
use Illuminate\Auth\Access\HandlesAuthorization;
use phpDocumentor\Reflection\Types\Null_;

class QuestionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the question.
     *
     * @param  \App\User  $user
     * @param  \App\Question  $question
     * @return mixed
     */
    public function view(User $user)
    {
        return ($user->id === 1);
    }

    /**
     * Determine whether the user can create questions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user,$id)
    {
        $cat = Category::find($id);
        if($cat == null)
            return false;
        else
            return true;
        //return $user->id > 0;
    }

    /**
     * Determine whether the user can update the question.
     *
     * @param  \App\User  $user
     * @param  \App\Question  $question
     * @return mixed
     */
    public function update(User $user, Question $question)
    {
        return $user->id === $question->user_id;
    }

    /**
     * Determine whether the user can delete the question.
     *
     * @param  \App\User  $user
     * @param  \App\Question  $question
     * @return mixed
     */
    public function delete(User $user, Question $question)
    {
        if(($user->id === $question->user_id) || ($user->id === 1))
            return TRUE;
        else
            return FALSE;
    }

    /**
     * Determine whether the user can restore the question.
     *
     * @param  \App\User  $user
     * @param  \App\Question  $question
     * @return mixed
     */
    public function restore(User $user, Question $question)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the question.
     *
     * @param  \App\User  $user
     * @param  \App\Question  $question
     * @return mixed
     */
    public function forceDelete(User $user, Question $question)
    {
        //
    }

    public function upvote(User $user,Question $question)
    {
        dd('sjjk');
//        if($question->user_id !== $user->id)
//            return TRUE;
//        else
//            return FALSE;
    }
}
