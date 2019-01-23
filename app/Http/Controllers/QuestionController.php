<?php

namespace App\Http\Controllers;

use App\Question;
use App\Repositories\Question\EloquentQuestion;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class QuestionController extends Controller
{
   /* public function view()
    {
        // get current logged in user
        $user = Auth::user();

        // load question
        $question = Question::find(1);

        if ($user->can('view', $question)) {
            echo "Current logged in user is allowed to update the Question: {$question->id}";
        } else {
            echo 'Not Authorized.';
        }
    }

    public function create()
    {
        // get current logged in user
        $user = Auth::user();

        if ($user->can('create', Question::class)) {
            echo 'Current logged in user is allowed to create new questions.';
        } else {
            echo 'Not Authorized';
        }

        exit;
    }

    public function update()
    {
        // get current logged in user
        $user = Auth::user();

        // load question
        $question = Question::find(1);

        if ($user->can('update', $question)) {
            echo "Current logged in user is allowed to update the Question: {$question->id}";
        } else {
            echo 'Not Authorized.';
        }
    }

    public function delete()
    {
        // get current logged in user
        $user = Auth::user();

        // load question
        $question = Question::find(1);

        if ($user->can('delete', $question)) {
            echo "Current logged in user is allowed to delete the Question: {$question->id}";
        } else {
            echo 'Not Authorized.';
        }
    }*/

    protected $question;
   public function __construct(Question $q)
   {
        $this->question = new EloquentQuestion($q);
   }

   public function show()
   {
       return $this->question->getAll();
   }
   public function store()
   {
        $this->question->create(request(['title','description']));
        return view('home');
   }
   public function update($id)
   {
       $this->question->update($id,request(['title','description']));
        return $this->question->find($id);
   }
   public function destroy($id)
   {
       $this->question->delete($id);
       return view('home');

   }
   public function getQuestionById($id)
   {
        return $this->question->getQuestionById($id);
   }
   public function showAllUserQuestions($id)
   {
       return $this->question->getAllQuestionsByUserId($id);
   }
   public function showAllCategoryQuestions($category)
   {
       return $this->question->getAllQuestionsByCategory($category);
   }
}
