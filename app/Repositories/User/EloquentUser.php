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
        return $this->model->getUserCount();
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
        return $this->model->up($id,$attr);
    }

    public function remove($id)
    {
       // dd($this->getById($id)->roles()->get()->toArray());
        return $this->model->del($id);
        //return "TRUE";
 /*       $user=  $this->getById($id);

        $user->delete();
        $user->userroles()->delete();

        return "true";
   */ }
}
