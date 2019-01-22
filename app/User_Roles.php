<?php

namespace App;
use DB;
use App\Http\Controllers\UserRolesController;
use Illuminate\Database\Eloquent\Model;

class User_Roles extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [
        'role_id','user_id'
    ];

    public static function addUserRole(){

        $role=Role::where('name','User')->pluck('id');
        $user = User::latest()->first();

        $urole = DB::table('user__roles')->insert([
            'role_id' => $role[0],
            'user_id' => $user->id
        ]);

        return $urole;
    }
}
