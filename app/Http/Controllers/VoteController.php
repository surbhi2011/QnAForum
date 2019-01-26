<?php

namespace App\Http\Controllers;

use App\Repositories\Vote\VoteRepository;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    private $vote;
    public function __construct(VoteRepository $vote)
    {
        $this->vote = $vote;
    }

    public function getQuestionUpvotes($id)
    {
        return $this->vote->getByQUpVote($id);
    }

    public function getQuestionDownvotes($id)
    {
        return $this->vote->getByQDownVote($id);
    }

    public function getAnswerUpvotes($id)
    {
        return $this->vote->getByAUpVote($id);
    }

    public function getAnswerDownvotes($id)
    {
        return $this->vote->getByADownVote($id);
    }

    public function store()
    {
        dd('bauii');
        //return $this->vote->create($data);
    }

//    public function deleteByAId($id)
//    {
//        return $this->vote->delete($id);
//    }
}
