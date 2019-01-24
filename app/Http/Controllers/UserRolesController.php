<?php

namespace App\Http\Controllers;

use App\Repositories\User_Role\EloquentUserRoles;
use App\User_Roles;
use Illuminate\Http\Request;

class UserRolesController extends Controller
{
    protected $userroles;
    public function __construct(User_Roles $ur)
    {
        $this->userroles= new EloquentUserRoles($ur);
    }
    public function store()
    {
        $this->userroles->create(request(['role_id','user_id']));
    }
    public function destroy($user_id,$role_id)
    {
        $this->userroles->delete($user_id,$role_id);
    }
}
