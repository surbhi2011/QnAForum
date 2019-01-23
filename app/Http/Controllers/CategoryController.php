<?php

namespace App\Http\Controllers;

use App\Category;
use App\Repositories\Category\EloquentCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /*public function view()
    {
        // get current logged in user
        $user = Auth::user();

        // load category
        $category = Category::find(1);

        if ($user->can('view', $category)) {
            echo "Current logged in user is allowed to update the Category: {$category->id}";
        } else {
            echo 'Not Authorized.';
        }
    }

    public function create()
    {
        // get current logged in user
        $user = Auth::user();

        if ($user->can('create', Category::class)) {
            echo 'Current logged in user is allowed to create new categorys.';
        } else {
            echo 'Not Authorized';
        }

        exit;
    }

    public function update()
    {
        // get current logged in user
        $user = Auth::user();

        // load category
        $category = Category::find(1);

        if ($user->can('update', $category)) {
            echo "Current logged in user is allowed to update the Category: {$category->id}";
        } else {
            echo 'Not Authorized.';
        }
    }

    public function delete()
    {
        // get current logged in user
        $user = Auth::user();

        // load category
        $category = Category::find(1);

        if ($user->can('delete', $category)) {
            echo "Current logged in user is allowed to delete the Category: {$category->id}";
        } else {
            echo 'Not Authorized.';
        }
    }*/
    protected $category;
    public function __construct(Category $c)
    {
        $this->category = new EloquentCategory($c);
    }
    public function getCategoryById($id)
    {
        return $this->category->getById($id);
    }
    public function store()
    {
        $this->category->create(request(['name']));
    }
    public function updatecategory($id)
    {
        return $this->category->update(request(['name']),$id);
    }
    public function destroy($id)
    {
        $this->category->delete($id);
    }

}
