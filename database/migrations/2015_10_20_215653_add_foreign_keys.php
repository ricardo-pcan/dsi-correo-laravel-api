<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add foreign keys

        Schema::table('comments', function($table)
        {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('request_id')->references('id')->on('requests');
        });

        Schema::table('requests', function($table)
        {
            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('comments', function($table)
        {
            $table->dropForeign('comments_user_id_foreign');
            $table->dropForeign('comments_request_id_foreign');
        });

        Schema::table('requests', function($table)
        {
            $table->dropForeign('requests_department_id_foreign');
        });
    }
}
