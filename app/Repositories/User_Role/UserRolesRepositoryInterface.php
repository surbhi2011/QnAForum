<?php
/**
 * Created by PhpStorm.
 * User: frost
 * Date: 24/1/19
 * Time: 11:16 AM
 */

namespace App\Repositories\User_Role;


interface UserRolesRepositoryInterface
{
    public function create($attributes);

    public function delete($user_id,$role_id);
}
