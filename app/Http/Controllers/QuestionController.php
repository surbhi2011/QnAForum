<?php

namespace App\Http\Controllers;

use App\Vote;
use App\Question;
use App\Repositories\Question\EloquentQuestion;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    protected $question;
   public function __construct(Question $q)
   {
        $this->question = new EloquentQuestion($q);
   }

   public function show(Request $request)
   {
       $key = $request->keys();
       if(in_array('category',$key))
       {
           $name = $request->query('category');
           return $this->question->getAllQuestionsByCategory($name);
       }
       if(in_array('sort',$key))
       {
           $type = $request->query('sort');
           return $this->question->getAll($type);
       }
   }
   public function store($id)
   {
        return $this->question->create(request(['title','description']),$id);
   }
   public function updatequestion($id)
   {
      return $this->question->update(request(['title','description']),$id);
   //     return $this->question->getQuestionById($id);
   }
   public function destroy($id)
   {
       //dd($this->authorize('delete','$id'));
       $this->question->delete($id);
       return view('home');
   }
   public function getQuestionById($id)
   {
        return $this->question->getQuestionById($id);
   }
   public function getQuestionList($id)
   {
       return $this->question->getList($id);
   }

   public function showAllUserQuestions($id)
   {
       return $this->question->getAllQuestionsByUserId($id);
   }
   public function showAllCategoryQuestions(Request $request)
   {

   }
   public function getCount()
   {
       return $this->question->getAllCount();
   }
   public function upvote($id)
   {
       $data = [
           'voteable_id' => $id,
           'voteable_type' => Question::class,
           'type' => 1
       ];
       return (new Vote())->add($data);
   }
   public function downvote($id)
   {

       $data = [
           'voteable_id' => $id,
           'voteable_type' => Question::class,
           'type' => 0
       ];
       return (new Vote())->add($data);
   }
}
