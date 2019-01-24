<?php

namespace App\Http\Controllers;

use App\Repositories\Role\EloquentRole;
use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
   /* public function view()
    {
        // get current logged in user
        $user = Auth::user();

        // load role
        $role = Role::find(1);

        if ($user->can('view', $role)) {
            echo "Current logged in user is allowed to update the Role: {$role->id}";
        } else {
            echo 'Not Authorized.';
        }
    }

    public function create()
    {
        // get current logged in user
        $user = Auth::user();

        if ($user->can('create', Role::class)) {
            echo 'Current logged in user is allowed to create new roles.';
        } else {
            echo 'Not Authorized';
        }

        exit;
    }

    public function update()
    {
        // get current logged in user
        $user = Auth::user();

        // load role
        $role = Role::find(1);

        if ($user->can('update', $role)) {
            echo "Current logged in user is allowed to update the Role: {$role->id}";
        } else {
            echo 'Not Authorized.';
        }
    }

    public function delete()
    {
        // get current logged in user
        $user = Auth::user();

        // load role
        $role = Role::find(1);

        if ($user->can('delete', $role)) {
            echo "Current logged in user is allowed to delete the Role: {$role->id}";
        } else {
            echo 'Not Authorized.';
        }
    }*/

   protected $role;

   public function __construct(Role $r)
   {
       $this->role= new EloquentRole($r);
   }

   public function store()
   {
       $this->role->create(request(['name']));
   }
   public function updaterole($id)
   {
       $this->role->update(request(['name']), $id);
   }
   public function destroy($id)
   {
       $this->role->delete($id);
   }
}
