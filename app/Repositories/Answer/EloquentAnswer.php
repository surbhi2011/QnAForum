<?php
/**
 * Created by PhpStorm.
 * User: surbhi
 * Date: 23/1/19
 * Time: 4:44 PM
 */

namespace App\Repositories\Answer;

use Illuminate\Support\Facades\Auth;
use App\Question;
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

    public function getCountAnswers($id)
    {
        return $this->getAnswerByQId($id)->count();
    }

    public function getAnswerById($id)
    {
        return $this->model->find($id);
    }

    public function getAnswerByQId($id)
    {
        $que = Question::find($id)->answers()->get();
        //dd($que);
        return $que;
    }

    public function getAnswersByUserId()
    {
        $user = Auth::user();
        //return $user;
        return $this->model->where('user_id', $user->id)->get();
    }

    public function create($qid,array $attributes)
    {
        return $this->model->add($qid,$attributes);
    }

    public function update($id, array $attributes)
    {
        $ans = $this->model->findOrFail($id);
        $ans->update($attributes);
        return $ans;
    }

    public function remove($id)
    {
        $this->getAnswerById($id)->delete();
        return true;
    }
//
//    public function removeAnswer($id)
//    {
//        $que = $this->getAnswerByQId($id)->toArray();
//        $ids = array_map(function($item){ return $item['id']; }, $que);
//        $this->model->destroy($ids);
//        return true;
//    }
}
