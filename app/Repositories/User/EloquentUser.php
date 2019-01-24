<?php
/**
 * Created by PhpStorm.
 * User: surbhi
 * Date: 22/1/19
 * Time: 3:10 PM
 */

namespace App\Repositories\User;
use App\User;

class EloquentUser implements UserRepository
{
    private $model;

    public function __construct(User $user)
    {
            $this->model = $user;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $attr)
    {
        return $this->model->add($attr);
    }

    public function update($id,array $attr)
    {
        $user = $this->model->findOrFail($id);
        $user->update($attr);
        return $user;
    }

    public function remove($id)
    {
        $this->getById($id)->delete();
        return "true";
    }
}
