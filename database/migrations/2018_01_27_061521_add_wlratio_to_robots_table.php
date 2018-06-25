<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWlratioToRobotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('robots', function (Blueprint $table) {
//            $table->float('wlratio', 7, 6);
//        });

          Schema::create('wlratios', function (Blueprint $table) {
              $table->increments('id');
              $table->timestamps();
              $table->integer('robot_id')->unsigned();
              $table->foreign('robot_id')->references('id')->on('robots');
              $table->float('ratio', 7, 6)->default('0');
              $table->integer('fight')->unsigned();	      
              $table->integer('win')->unsigned();	      
              $table->integer('lose')->unsigned();	      

          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wlratios');   
    }
}
