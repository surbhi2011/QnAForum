<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use phpDocumentor\Reflection\Types\Integer;

class Question extends Model
{
    protected $fillable=[
      'title','description','user_id','category_id'
    ];

    public function add(array $attributes)
    {
        $user = Auth::user();
        $id = $user->id;
        $cat_id = 1;
        $question = Question::create([
            'title' => $attributes['title'],
            'description' => $attributes['description'],
            'user_id' => $id,
            'category_id' => $cat_id
        ]);
        return $question;
    }
    public function up($id,array $attributes)
    {
        $question = Question::update($id,[
            'title' => $attributes['title'],
            'description' => $attributes['description'],
        ]);
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
        $question = Question::where('user_id',$id)->get();
        return $question;
    }
    public function getAllCategoryQuestions($category)
    {
        //$categoryid=Category::where('name',$category);
        //$question = Question::where('category_id',$categoryid)->get();
        $question = Question::where('category_id',$category)->get();
        return $question;
    }


}
