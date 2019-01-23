<?php
/**
 * Created by PhpStorm.
 * User: frost
 * Date: 23/1/19
 * Time: 5:41 PM
 */

namespace App\Repositories\Category;


interface CategoryRepositoryInterface
{
    public function getById($id);

    public function create(array $attributes);

    public function update(array $attributes,$id);

    public function delete($id);

}
