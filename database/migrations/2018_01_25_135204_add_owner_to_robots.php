<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOwnerToRobots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('robots', function($table) {
            $table->integer('owner_id')->unsigned()->nullable();
        });

        Schema::table('robots', function($table) {
            $table->foreign('owner_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
           
        Schema::table('robots', function($table) {
            $table->dropForeign('robots_owner_id_foreign');
        });


    }
}
