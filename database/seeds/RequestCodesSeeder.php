<?php

use Illuminate\Database\Seeder;
use dsiCorreo\Request as dsiRequest;
use Faker\Factory as Faker;
use dsiCorreo\Department;
use dsiCorreo\RequestCode;


class RequestCodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $status_request = dsiRequest::$Status['Solicitado a DCyC'];
        $first_department_id = Department::first()->id;
        $last_department_id = DB::table('departments')->orderBy( 'id', 'desc' )->first()->id;
        for ( $i = 0; $i < 3; $i++ )
        {
            $request = new dsiRequest(
                array(
                    'first_name' => $faker->firstName,
                    'first_last_name' => $faker->lastName,
                    'second_last_name' => $faker->lastName,
                    'status' => $status_request,
                    'employee_id' => $faker->randomNumber( 5 ),
                    'role' => $faker->numberBetween( dsiRequest::$Roles['Administrativo'], dsiRequest::$Roles['Honorarios']  ),
                    'extension_number' => $faker->randomNumber( 5 ),
                    'department_id' => $faker->numberBetween( $first_department_id, $last_department_id  ),
                    'alternative_mail' => $faker->email
                )
            );

            $request->save();

            $request_code = new RequestCode(
                array(
                    'code' => $faker->randomNumber( 8 )
                )
            );

            $request_code = $request->requestCode()->save( $request_code );
        }
    }
}
