<?php

use Illuminate\Database\Seeder;
use dsiCorreo\Department;
use Faker\Factory as Faker;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_requests')->delete();
        DB::table('requests')->delete();
        DB::table('users')->delete();
        DB::table('departments')->delete();
        $faker = Faker::create();
        for( $i = 0; $i < 30; $i++ )
        {
            Department::create([
                'name' => $faker->company,
                'description' => $faker->text($maxNbChars = 100)
            ]);
        }
    }
}
