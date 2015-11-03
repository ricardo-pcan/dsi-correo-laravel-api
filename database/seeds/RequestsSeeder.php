<?php

use Illuminate\Database\Seeder;
use dsiCorreo\Department;
use dsiCorreo\Request as dsiRequest;
use dsiCorreo\User;
use Faker\Factory as Faker;

class RequestsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $first_user_id = User::first()->id;
        $last_user_id = DB::table('users')->orderBy('id', 'desc')->first()->id;
        $last_department_id = DB::table('departments')->orderBy('id', 'desc')->first()->id;
        $first_department_id = Department::first()->id;
        $status = dsiRequest::$Status['Solicitado a DSI'];

        for ( $i = 0; $i < 30; $i++ )
        {
            $request = new dsiRequest(
                array(
                    'first_name' => $faker->firstName,
                    'first_last_name' => $faker->lastName,
                    'second_last_name' => $faker->lastName,
                    'employee_id' => $faker->randomNumber( 5 ),
                    'role' => $faker->numberBetween(0, count( dsiRequest::$Roles['list'] ) ),
                    'department_id' => $faker->numberBetween($first_department_id, $last_department_id),
                    'alternative_mail' => $faker->email,
                    'status' => $status

                )
            );
            $select_user_id = $faker->numberBetween( $first_user_id, $last_user_id );
            $user = User::find( $select_user_id );
            $request = $user->requests()->save( $request );
        }
    }
}
