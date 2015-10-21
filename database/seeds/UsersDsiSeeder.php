<?php

use Illuminate\Database\Seeder;
use dsiCorreo\Role;
use dsiCorreo\User;

class UsersDsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user_dsi = User::create(
            array(
                'name' => 'julito',
                'email' => 'julito@dsi_cgfie.local',
                'password' => Crypt::encrypt('123456')
            )
        );

        $user_dsi_role = Role::where( 'name', '=', 'user_dsi')->get()->first();
        $user_dsi->attachRole( $user_dsi_role );
    }
}
