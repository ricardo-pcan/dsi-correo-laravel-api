<?php

use Illuminate\Database\Seeder;
use dsiCorreo\Comment;
use dsiCorreo\User;
use dsiCorreo\Request as dsiRequest;
use Faker\Factory as Faker;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $first_user_id = User::first()->id;
        $last_user_id = DB::table( 'users' )->orderBy( 'id', 'desc' )->first()->id;
        $first_request_id = dsiRequest::first()->id;
        $last_request_id = DB::table( 'requests' )->orderBy( 'id', 'desc' )->first()->id;

        for( $i = 0; $i < 30; $i++ )
        {
            $comment = new Comment(array(
                'content' => $faker->text( 100 ),
                'user_id' => $faker->numberBetween( $first_user_id, $last_user_id ),
                'request_id' => $faker->numberBetween( $first_request_id, $last_request_id )
            ));
            $comment->save();
        }

    }
}
