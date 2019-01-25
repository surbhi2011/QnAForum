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

    public function question()
    {
        return $this->belongsTo('App\Question','question_id','id');
    }

    public function votes()
    {
        return $this->morphMany('App\Vote','voteable');
    }

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

    public function del($id)
    {
        Answer::find($id)->votes()->delete();
        Answer::find($id)->delete();
        return true;
    }
}
