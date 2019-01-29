<?php

namespace App;
use DB;
use App\User_Roles;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
//use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;
  //  use SoftCascadeTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  //  private $user;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name', 'email', 'password'
    ];

//    protected $softCascade = ['userroles'];

    /*public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->user = Auth::user();
    }*/

    public $timestamps = true;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $redirectedTo = '/home';

    public function add(array $attributes)
    {
        $user = User::create([
            'name' => $attributes[0],
            'email' => $attributes[1],
            'password' => Hash::make($attributes[2]),
        ]);
        User_Roles::addUserRole();
        return $user;
    }
    public function up($id, array $attributes)
    {
        $u = Auth::user();
        $us = User::findOrFail($id);
        if ($u->can('update', $us)) {
            $us->update($attributes);
            return $us;
        }
        $response= [
            "message"=>"You can't update other user details"
        ];
        return response()->json($response);

    }
    public function getAllUsers()
    {
        $u = Auth::user();
        if($u->can('view',$u))
        {
            $user = User::all();
            return $user;
        }
    }
    public function del($id)
    {
        $u= Auth::user();
        $us = User::findOrFail($id);
        //if($u->can('delete',$model)) {
           // dd('test');
        if ($u->can('delete', $us)) {
            $us->delete();
            $us->userroles()->delete();

            $response= [
                "message"=>"user deleted"
            ];

            return response()->json($response);
        }
        $response= [
            "message"=>"You can not delete a user"
        ];
        return response()->json($response);

    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function questions()
    {
        return $this->hasMany('App\Question');
    }
    public function roles()
    {
        return $this->belongsToMany('App\Role','user__roles','user_id','role_id');
    }
    public function userroles()
    {
        return $this->hasMany('App\User_Roles', 'user_id','id');
    }

}
