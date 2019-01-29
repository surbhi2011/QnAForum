<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Vote extends Model
{
    private $user;
    protected $fillable = [
        'type', 'user_id','voteable_type', 'voteable_id',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->user = Auth::user();
    }

    public function add($attr)
    {
        $vote = new Vote();
        $mo= null;
        $result = null;
        if($attr['voteable_type'] === "App\Question")
        {
            $mo = Question::find($attr['voteable_id']);
            $result = $this->user->can('createQue',[$vote,$mo]);
        }
        else if($attr['voteable_type'] === "App\Answer")
        {
            $mo = Answer::find($attr['voteable_id']);
            $result = $this->user->can('createAns',[$vote,$mo]);
        }

        if($result) {
            $uid = $this->user->id;
            return $this->create([
                'type' => $attr['type'],
                'user_id' => $uid,
                'voteable_id' => $attr['voteable_id'],
                'voteable_type' => $attr['voteable_type']
            ]);
        }
        $response= [
            "message"=>"You cannot upvote/downvote your own question/answer"
        ];
        return response()->json($response);
    }

    public function voteable(){

        return $this->morphTo();
    }

//    public function getUpvote($id,Model $model)
//    {
//        return $model->find($id)->votes->where('type',1);
//    }
//
//    public function getDownvote($id,Model $model)
//    {
//        return $model->find($id)->votes->where('type',0);
//    }

}
