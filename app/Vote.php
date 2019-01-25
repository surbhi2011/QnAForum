<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Vote extends Model
{
    protected $fillable = [
        'type', 'user_id','voteable_type', 'voteable_id',
    ];

    public function add($attr)
    {
        $user = Auth::user();
        $uid = $user->id;
        return $this->create([
            'type' => $attr['type'],
            'user_id' => $uid,
            'voteable_id' => $attr['voteable_id'],
            'voteable_type' => $attr['voteable_type']
        ]);
    }

    public function voteable(){

        return $this->morphTo();
    }

    public function getUpvote($id,Model $model)
    {
        return $model->find($id)->votes->where('type',1);
    }

    public function getDownvote($id,Model $model)
    {
        return $model->find($id)->votes->where('type',0);
    }

}
