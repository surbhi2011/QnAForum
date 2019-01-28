<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    private $user;
    protected $fillable = [
        'description','question_id','user_id'
    ];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->user = Auth::user();
    }
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
        $que= Question::findOrFail($qid);

       // dd($que->toArray());
        $answer = new Answer();
        if($this->user->can('create',[$answer,$que])) {
            //dd('test');
            $id = $this->user->id;
            $answer = Answer::create([
                'description' => $attributes['description'],
                'user_id' => $id,
                'question_id' => $qid
            ]);
            return $answer;
        }
        return "U can not answer to your own question.";
    }

    public function del($id)
    {
        $ans= Answer::findOrFail($id);
        if($this->user->can('delete',$ans)) {
            Answer::find($id)->votes()->delete();
            Answer::find($id)->delete();
            return "true";
        }
        return "unauthorized";
    }
    public function up($id, array $attributes)
    {
        $ans = Answer::findOrFail($id);
        if($this->user->can('update',$ans)) {
            $ans = Answer::findOrFail($id);
            $ans->update($attributes);
            return $ans;
        }
        return "uthauthorized";
    }
    public static function getAnswer($id)
    {
        $ans = Answer::find($id);
        $a = new Answer();
        $up = $ans->votes()->where('type','1')->count();
        $down = $ans->votes()->where('type','0')->count();
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
