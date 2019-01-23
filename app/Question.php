<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class Question extends Model
{
    protected $fillable=[
      'title','description','user_id','category_id'
    ];

    public function add(array $attributes)
    {
        $user=Auth::user();
        $id=$user->id;
        $cat_id=1;
        $question = Question::create([
            'title' => $attributes['title'],
            'description' => $attributes['description'],
            'user_id'=>$id,
            'category_id'=>$cat_id
        ]);


        return $question;
    }
}
