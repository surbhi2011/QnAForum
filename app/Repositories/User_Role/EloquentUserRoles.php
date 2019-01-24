<?php
/**
 * Created by PhpStorm.
 * User: frost
 * Date: 24/1/19
 * Time: 11:15 AM
 */

namespace App\Repositories\User_Role;


use App\User_Roles;

class EloquentUserRoles implements UserRolesRepositoryInterface
{
    protected $userroles;

    public function __construct(User_Roles $userroles)
    {
        $this->userroles=$userroles;
    }

    public function create($attributes)
    {
        $this->userroles->add($attributes);
    }

    public function delete($user_id,$role_id)
    {
        $this->userroles->del($user_id,$role_id)->delete();
        return true;
    }

}
