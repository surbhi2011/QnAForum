<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Repositories\Answer\AnswerRepository;
use App\Vote;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    private $answer;

    public function __construct(AnswerRepository $answer)
    {
        $this->answer = $answer;
    }

    public function getAllAnswers()
    {
        return $this->answer->getAll();
    }
    public function getAnswer($id)
    {
        return $this->answer->getAnswerById($id);
    }
    public function getAnswerByQuestion($id)
    {
        return $this->answer->getAnswerByQId($id);
    }
    public function store($qid)
    {
        return $this->answer->create($qid,request(['description']));
    }
    public function update($id)
    {
        return $this->answer->update($id,request(['description']));
    }
    public function delete($id)
    {
        return $this->answer->remove($id);
    }
//    public function deleteAnswer($id)
//    {
//        return $this->answer->removeAnswer($id);
//    }
    public function getUserAnswers()
    {
        return $this->answer->getAnswersByUserId();
    }

    public function getCount($id)
    {
        return $this->answer->getCountAnswers($id);
    }

    public function upVote($id)
    {
        $data = [
            'type' => 1,
            'voteable_type' => Answer::class,
            'voteable_id' => $id
        ];
        return (new Vote())->add($data);
    }

    public function downVote($id)
    {
        $data = [
            'type' => 0,
            'voteable_type' => Answer::class,
            'voteable_id' => $id
        ];
        return (new Vote())->add($data);
    }
}
