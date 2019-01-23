<?php
/**
 * Created by PhpStorm.
 * User: surbhi
 * Date: 23/1/19
 * Time: 4:44 PM
 */

namespace App\Repositories\Answer;


use App\Answer;

class EloquentAnswer implements AnswerRepository
{
    private $model;

    public function __construct(Answer $answer)
    {
        $this->model = $answer;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getCountAnswers()
    {
        // TODO: Implement getCountAnswers() method.
    }

    public function getAnswerById($id)
    {
        return $this->model->find($id);
    }

    public function getAnswerByQId($id)
    {
        return $this->model->where('question_id', $id)->get();
    }

    public function getAnswersByUserId($id)
    {
        // TODO: Implement getAnswersByUserId() method.
    }

    public function create(array $attributes)
    {
        // TODO: Implement create() method.
    }

    public function update($id, array $attributes)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

}