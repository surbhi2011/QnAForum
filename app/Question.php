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
//        dd($attributes['title']);
        $user = Auth::user();
        $id = $user->id;
        $cat_id = 2;
        $question = Question::create([
            'title' => $attributes['title'],
            'description' => $attributes['description'],
            'user_id' => $id,
            'category_id' => $cat_id
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

        $question = Question::find($id);
        //$question = Question::where('id',$id)->get();
        return $question;
    }
    public function getQuestion($id)
    {
        $question = Question::find($id);
        //$question = Question::where('id',$id)->get();
        return $question;
    }

    public function getAllUserQuestions($id)
    {
        $question = User::find($id)->questions()->get();
        //$question = Question::where('user_id',$id)->get();
        return $question;
    }
    public function getAllCategoryQuestions($category)
    {

        //$categoryid=Category::where('name',$category);
        //$question = Question::where('category_id',$categoryid)->get();
        //$question = Question::where('category_id',$category)->get();
        $question = Category::find($category)->questions()->get();
        return $question;
    }
    public function getOldestFirst()
    {
        $question = Question::latest('id')->get();
        return $question;
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
