<?php

namespace App;
use DB;
use App\User_Roles;
use Illuminate\Support\Facades\Auth;
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
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name', 'email', 'password'
    ];

//    protected $softCascade = ['userroles'];

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
    private $users;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->users = Auth::user();
    }

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

    public function up($id,array $attr)
    {
        $u = User::find($id);
        dd('kldms');
        if($this->users->can('update', $u)) {
            dd('jdaksldm');
            $us = $this->findOrFail($id);
            $us->update($attr);
            return $us;
        }
        return "Unauthorized";
    }

    public function del($id)
    {
        $user=  $this->getById($id);
        $user->delete();
        $user->userroles()->delete();
        return true;
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
