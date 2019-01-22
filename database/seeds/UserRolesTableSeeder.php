<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=DB::table('users')->latest()->first();
        $role=DB::table('roles')->where('name','SuperAdmin')->pluck('id');
        //$role=Role::where('name' , 'SuperAdmin')->get();
        DB::table('user__roles')->insert([
           'role_id'=> $role[0],
            'user_id'=> $user->id,
        ]);
    }
}
