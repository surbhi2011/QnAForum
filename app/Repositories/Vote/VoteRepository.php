<?php
/**
 * Created by PhpStorm.
 * User: surbhi
 * Date: 24/1/19
 * Time: 10:34 AM
 */

namespace App\Repositories\Vote;


interface VoteRepository
{
    public function getByUser($id);

    public function getByQUpVote($id);

    public function getByQDownVote($id);

    public function getByAUpVote($id);

    public function getByADownVote($id);

    public function create($attr);

    public function delete($id);
}