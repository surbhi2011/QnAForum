<?php
/**
 * Created by PhpStorm.
 * User: surbhi
 * Date: 24/1/19
 * Time: 10:35 AM
 */

namespace App\Repositories\Vote;

use App\Answer;
use App\Vote;
use App\Question;

class EloquentVote implements VoteRepository
{
    private $vote;

    public function __construct(Vote $vote)
    {
        $this->vote = $vote;
    }

    public function getByUser($id)
    {
        // TODO: Implement getByUser() method.
    }

    public function getByQUpVote($id)
    {
        $que = new Question();
        return  $this->vote->getUpvote($id,$que);
    }

    public function getByQDownVote($id)
    {
        $que = new Question();
        return  $this->vote->getDownvote($id,$que);
    }

    public function getByAUpVote($id)
    {
        $ans = new Answer();
        return  $this->vote->getUpvote($id,$ans);
    }

    public function getByADownVote($id)
    {
        $ans = new Answer();
        return  $this->vote->getDownvote($id,$ans);
    }

    public function create($attr)
    {
        return $this->vote->add($attr);
    }

    public function delete($id)
    {
        $que = $this->getAnswerByQId($id)->toArray();
        $ids = array_map(function($item){ return $item['id']; }, $que);
        $this->model->destroy($ids);
        return true;
    }
}