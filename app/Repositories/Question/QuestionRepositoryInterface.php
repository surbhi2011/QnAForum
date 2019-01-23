<?php
/**
 * Created by PhpStorm.
 * User: frost
 * Date: 22/1/19
 * Time: 3:16 PM
 */

namespace App\Repositories\Question;


use phpDocumentor\Reflection\Types\Integer;

interface QuestionRepositoryInterface
{
    public function getAll();

    public function getQuestionById($id);

    public function getAllQuestionsByUserId($id);

    public function getAllQuestionsByCategory($id);

    public function getByOldest();

    public function getAllCount();

    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete($id);
}
