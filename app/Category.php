<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;


class Category extends Model
{
    protected $fillable=[
        'name'
    ];
    public function getCategory($id)
    {
        $category = Category::find($id);
        return $category;
    }
    public function add($attributes)
    {
        $category = Category::create([
            'name' => $attributes['name'],
        ]);
        return $category;
    }
    public function up($attributes,$id)
    {
        $category = Category::find($id);
        $category->update($attributes);
    }
    public function del($id)
    {
        $category = Category::find($id);
        return $category;
    }
}
