<?php

use Illuminate\Database\Seeder;
use dsiCorreo\Role;
use dsiCorreo\User;
use dsiCorreo\Department;
use Faker\Factory as Faker;

class UsersDsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $first_id_department = Department::first()->id;
        $last_id_department = DB::table('departments')->orderBy('id', 'desc')->first()->id;

        $user_dsi = new User(
            array(
                'name' => 'julito',
                'email' => 'julito@dsi_cgfie.local',
                'department_id' => $faker->numberBetween($first_id_department, $last_id_department),
                'password' => bcrypt( '123456' )
            )
        );
        $user_dsi->save();
        $user_dsi_role = Role::where( 'name', '=', 'user_dsi')->get()->first();
        $user_dsi->attachRole( $user_dsi_role );
    }
}
