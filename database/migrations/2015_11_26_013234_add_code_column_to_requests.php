<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCodeColumnToRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'requests', function( $table ){
            $table->string( 'request_code', 50 );
        });
        Schema::drop( 'request_codes' );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table( 'requests', function( $table ){
            $table->dropColumn( 'request_code' );
        } );
        Schema::create('request_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('request_id')->unsigned();
            $table->string('code', 50);
            $table->timestamps();
        });

    }
}
