<?php
/**
 * Created by PhpStorm.
 * User: surbhi
 * Date: 22/1/19
 * Time: 3:12 PM
 */

namespace App\Repositories\User;


interface UserRepository
{
    public function getAll();

    public function getById($id);

    public function create(array $attributes);

    public function edit($id, array $attributes);

    public function remove($id);
}