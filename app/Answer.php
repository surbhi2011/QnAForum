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

    public static function getAnswer($id)
    {
        $ans = Answer::find($id);
        $a = new Answer();
        $up = (new Vote())->getUpvote($id,$a)->count();
        $down = (new Vote())->getDownvote($id,$a)->count();
        $name = User::find($ans->user_id)->name;
        $data = [
            'Answer Description' => $ans->description,
            'Answer upvotes' => $up,
            'Answer Downvotes' => $down,
            'Answer given by' => $name
        ];
        return $data;
    }

}
