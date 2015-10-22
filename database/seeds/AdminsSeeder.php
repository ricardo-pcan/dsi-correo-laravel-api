<?php

use Illuminate\Database\Seeder;
use dsiCorreo\Role;
use dsiCorreo\User;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->delete();
        $admin = User::create(
            array(
                'name' => 'Admin',
                'email' => 'admin@dsi_cgfie.local',
                'password' => Crypt::encrypt('dsi')
            )
        );
        $admin_role = Role::where('name', '=', 'admin')->get()->first();
        $admin->attachRole( $admin_role );
    }
}
