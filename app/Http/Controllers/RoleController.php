<?php

namespace App\Http\Controllers;

use App\Repositories\Role\EloquentRole;
use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{


   protected $role;

   public function __construct(Role $r)
   {
       $this->role= new EloquentRole($r);
   }

   public function store()
   {
       return $this->role->create(request(['name']));
   }
   public function updaterole($id)
   {
       return $this->role->update(request(['name']), $id);
   }
   public function destroy($id)
   {
       return $this->role->delete($id);
   }
}
