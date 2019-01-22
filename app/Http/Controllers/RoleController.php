<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function view()
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
    }
}
