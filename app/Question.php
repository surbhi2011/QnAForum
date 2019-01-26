<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\Answer;

class Question extends Model
{
    protected $fillable=[
      'title','description','user_id','category_id'
    ];

    public function answers()
    {
        return $this->hasMany('App\Answer','question_id','id');
    }

    public function votes()
    {
        return $this->morphMany('App\Vote','voteable');
    }

    public function add(array $attributes, $id)
    {
//        dd($attributes['title']);
        $user = Auth::user();
        $uid = $user->id;
        $question = Question::create([
            'title' => $attributes['title'],
            'description' => $attributes['description'],
            'user_id' => $uid,
            'category_id' => $id
        ]);
        return $question;
    }
    public function up(array $attributes, $id)
    {
        $question =Question::find($id);
        $question->update($attributes);
        return $question;
    }

    public function del($id)
    {
        $ans=Question::find($id)->answers()->get();
        //dd($ans);
        foreach ($ans as $a)
        {
            $a->del($a->id);
        }
      // Question::find($id)->answers()->delete();
        //dd('test');
        Question::find($id)->votes()->delete();
        Question::find($id)->delete();
        //$question = Question::where('id',$id)->get();
    }
    public function getQuestion($id)
    {
        $question = Question::find($id);
        return $question;
    }

    public function getAllUserQuestions($id)
    {
        $question = User::find($id)->questions()->get();
        return $question;
    }
    public function getAllCategoryQuestions($category)
    {
        $question = Category::find($category)->questions()->get();
        return $question;
    }
    public function getOldestFirst()
    {
        $question = Question::latest('id')->get();
        return $question;
    }

    public function getList($id)
    {
        $que = Question::find($id)->answers()-votes();
        return $que;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

}
