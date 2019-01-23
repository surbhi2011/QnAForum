<?php
/**
 * Created by PhpStorm.
 * User: frost
 * Date: 22/1/19
 * Time: 3:21 PM
 */

namespace App\Repositories\Question;
use App\Question;
use Illuminate\Database\Eloquent\Model;
use Auth;
use phpDocumentor\Reflection\Types\Integer;

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

    public function create(array $attributes)
    {
        return $this->question->add($attributes);

    }

    public function update(array $attributes, $id)
    {

        return $this->question->up($attributes,$id);
    }

    public function delete($id)
    {
        $this->question->del($id)->delete();
        return true;
    }


    public function getQuestionById($id)
    {
        return $this->question->getQuestion($id);
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
        // TODO: Implement getAllCount() method.
    }

}
