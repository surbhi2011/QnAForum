<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable=[
        'name'
    ];

    public function add($attributes)
    {
        $role= Role::create([
           'name'=>$attributes['name']
        ]);
        return $role;
    }

    public function up($attributes,$id)
    {
        $role = Role::find($id);
        $role->update($attributes);
        return $role;
    }
    public function del($id)
    {
        $role =Role::find($id);
        return $role;
    }

    public function roles()
    {
        return $this->belongsToMany('App\User','user__roles','role_id','user_id');
    }

}
