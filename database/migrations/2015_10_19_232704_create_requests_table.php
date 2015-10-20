<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 100);
            $table->string('first_last_name', 100);
            $table->string('second_last_name', 100)->nullable();
            $table->bigInteger('employee_id');
            $table->integer('role');
            $table->integer('extension_number');
            $table->bigInteger('department_id')->unsigned();
            $table->string('alternative_mail', 100);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('requests');
    }
}
