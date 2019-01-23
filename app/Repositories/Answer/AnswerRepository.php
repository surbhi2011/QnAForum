<?php
/**
 * Created by PhpStorm.
 * User: surbhi
 * Date: 23/1/19
 * Time: 4:43 PM
 */

namespace App\Repositories\Answer;


interface AnswerRepository
{
    public function getAll();

    public function getCountAnswers();

    public function getAnswerById($id);

    public function getAnswerByQId($id);

    public function getAnswersByUserId($id);

    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete($id);
}