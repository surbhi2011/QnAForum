<?php
/**
 * Created by PhpStorm.
 * User: frost
 * Date: 24/1/19
 * Time: 10:27 AM
 */

namespace App\Repositories\Role;
use App\Role;

class EloquentRole implements RoleRepositoryInterface
{
    protected $role;
    public function __construct(Role $role)
    {
        $this->role=$role;
    }

    public function create($attributes)
    {
       return $this->role->add($attributes);
    }

    public function update(array $attributes, $id)
    {
        return $this->role->up($attributes,$id);
    }

    public function delete($id)
    {
        return $this->role->del($id);
    }
}
