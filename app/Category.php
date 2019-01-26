<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Category extends Model
{
    private $user;
    protected $fillable=[
        'name',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->user = Auth::user();
    }

    public function getCategory($id)
    {
        $category = Category::find($id);
        return $category;
    }
    public function add($attributes)
    {
        if($this->user->can('create',Category::class))
        {
            $category = Category::create([
                'name' => $attributes['name'],
            ]);
            return $category;
        }
        return "Unauthorized";
    }
    public function up($attributes,$id)
    {
        $cat = Category::find($id);
        if($this->user->can('update',$cat)) {
            $category = Category::find($id);
            $category->update($attributes);
            return $category;
        }
        return "Unauthorized";
    }
    public function del($id)
    {
        $cat = Category::find($id);
        if($this->user->can('delete',$cat)) {
            $category = Category::find($id);
            return $category;
        }
        return "Unauthorized";
    }
    public function questions()
    {
        return $this->hasMany('App\Question');
    }
}
