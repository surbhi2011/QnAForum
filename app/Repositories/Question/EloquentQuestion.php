<?php
/**
 * Created by PhpStorm.
 * User: frost
 * Date: 22/1/19
 * Time: 3:21 PM
 */

namespace App\Repositories\Question;
use App\Answer;
use App\Vote;
use App\User;
use App\Question;
use Auth;

class EloquentQuestion implements QuestionRepositoryInterface
{
    protected $question;

    public function __construct(Question $q)
    {
        $this->question = $q;
    }

    public function getAll()
    {
        return $this->question->gall();
    }

    public function create(array $attributes,$id)
    {
        return $this->question->add($attributes,$id);

    }

    public function update(array $attributes, $id)
    {
        return $this->question->up($attributes,$id);
    }

    public function delete($id)
    {
        return $this->question->del($id);

    }

    public function getQuestionById($id)
    {
        return $this->question->getQuestion($id);
    }

    public function getList($id)
    {
         $que = $this->getQuestionById($id);
         $answers = $this->question->find($id)->answers()->get();
         $acollect = [];
         foreach ($answers as $ds)
         {
             $acollect[$ds->id] = Answer::getAnswer($ds->id);
         }

         $q = new Question();
         $qup = (new Vote())->getUpvote($id,$q)->count();
         $qdown = (new Vote())->getDownvote($id,$q)->count();
         $name = User::find($que->user_id)->name;
         $data = [
             'id' => $id,
             'title' => $que->title,
             'description' => $que->description,
             'Asked By' => $name,
             'Answer' => $acollect,
             'Question upvotes' => $qup,
             'Question downvotes' => $qdown
         ];
         //dd($data);
        return $data;
    }

    public function getAllQuestionsByUserId($id)
    {
        return $this->question->getAllUserQuestions($id);
    }

    public function getAllQuestionsByCategory($category)
    {
        return $this->question->getAllCategoryQuestions($category);
    }

    public function getByOldest()
    {
        return $this->question->getOldestFirst();
    }

    public function getAllCount()
    {
        return $this->question->getAllQuestionCount();
    }

}
