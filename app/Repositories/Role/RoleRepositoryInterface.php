<?php
/**
 * Created by PhpStorm.
 * User: frost
 * Date: 24/1/19
 * Time: 10:28 AM
 */

namespace App\Repositories\Role;


interface RoleRepositoryInterface
{
    public function create($attributes);

    public function update(array $attributes, $id);

    public function delete($id);
}
