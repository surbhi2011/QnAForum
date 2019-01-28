<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Category extends Model
{
//    private $user;
//    protected $fillable=[
//        'name',
//    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
//        $this->user = Auth::user();
    }

    public function getCategory($id)
    {
        $category = Category::findOrFail($id);
        return $category;
    }

    public function getNameAttribute()
    {
        //dd($this->attributes['name']);
        return $this->attributes['name'];
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
        $cat = Category::findOrFail($id);
        if($this->user->can('update',$cat)) {
            $cat->update($attributes);
            return $cat;
        }
        return "Unauthorized";
    }
    public function del($id)
    {
        $cat = Category::findOrFail($id);
        if($this->user->can('delete',$cat)) {
            $cat->delete();
            return "true";
        }
        return "Unauthorized";
    }
    public function questions()
    {
        return $this->hasMany('App\Question','category_id','id');
    }
}
