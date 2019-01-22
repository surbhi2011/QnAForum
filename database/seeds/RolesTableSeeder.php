<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data= array(
            array('name'=>'SuperAdmin'),
            array('name'=>'User'),
        );

        DB::table('roles')->insert($data);
    }
}
