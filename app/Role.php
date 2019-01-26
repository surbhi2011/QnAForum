<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable=[
        'name'
    ];
    private $user;
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->user = Auth::user();
    }

    public function add($attributes)
    {
        if($this->user->can('create',Role::class))
        {
            $role= Role::create([
                'name'=>$attributes['name']
            ]);
            return $role;
        }
        return "Unauthorized";
    }

    public function up($attributes,$id)
    {
        $role = Role::findOrFail($id);
        if($this->user->can('update',$role)) {
            $role->update($attributes);
            return $role;
        }
        return "Unauthorized";
    }
    public function del($id)
    {
        $role =Role::findOrFail($id);
        if($this->user->can('delete',$role))
        {
            $role->delete();
            return "true";
        }
        return "Unauthorized";
    }

    public function roles()
    {
        return $this->belongsToMany('App\User','user__roles','role_id','user_id');
    }

}
