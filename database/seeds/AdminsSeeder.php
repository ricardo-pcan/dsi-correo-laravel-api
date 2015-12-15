<?php

use Illuminate\Database\Seeder;
use dsiCorreo\Role;
use dsiCorreo\User;
use dsiCorreo\Department;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department_id = Department::first()->id;
        $admin = new User (
            array(
                'name' => 'Admin',
                'email' => 'admin@dsiCgfie.mx',
                'department_id' => $department_id,
                'password' => bcrypt('123456')
            )
        );
        $admin->save();
        $admin_role = Role::where('name', '=', 'admin')->get()->first();
        $admin->attachRole( $admin_role );
    }
}
