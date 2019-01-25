<?php
/**
 * Created by PhpStorm.
 * User: frost
 * Date: 22/1/19
 * Time: 3:21 PM
 */

namespace App\Repositories\Question;
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
        return $this->question->all();
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
        return $this->question->getQuestionById($id);
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
        return $this->getAll()->count();
    }

}
