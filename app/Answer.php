<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    protected $fillable = [
        'description','question_id','user_id'
    ];

    public function add($qid,array $attributes)
    {
        $user = Auth::user();
        $id = $user->id;
        $answer = Answer::create([
            'description' => $attributes['description'],
            'user_id' => $id,
            'question_id' => $qid
        ]);
        return $answer;
    }
}
