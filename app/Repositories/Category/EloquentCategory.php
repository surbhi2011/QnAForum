<?php
/**
 * Created by PhpStorm.
 * User: frost
 * Date: 23/1/19
 * Time: 5:41 PM
 */

namespace App\Repositories\Category;
use App\Category;
use Auth;



class EloquentCategory implements CategoryRepositoryInterface
{
    protected $category;
    public function __construct(Category $c)
    {
        $this->category = $c;
    }

    public function getById($id)
    {
        return $this->category->getCategory($id);
    }

    public function create(array $attributes)
    {
        return $this->category->add($attributes);
    }

    public function update(array $attributes,$id)
    {
        return $this->category->up($attributes,$id);
    }

    public function delete($id)
    {
        return $this->category->del($id)->delete();
    }

}
