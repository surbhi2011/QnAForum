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

    public function getQuestionById($id)
    {
        return $this->find($id);
    }
    public function getAllQuestionsByUserId($id)
    {
        return $this->find($id)->all();
    }

    public function getAllQuestionsByCategory(string $attribute)
    {
        return $this->findByString($attribute)->all();
    }

    public function getByOldest()
    {
        // TODO: Implement getByOldest() method.
    }

    public function getAllCount()
    {
        // TODO: Implement getAllCount() method.
    }

    public function create(array $attributes)
    {

        return $this->question->add($attributes);

    }

    public function update($id, array $attributes)
    {

        $question = $this->question->findOrFail($id);
        return $question -> update($attributes);
    }

    public function delete($id)
    {
        $this->getById($id)->delete();
        return true;
    }

}
