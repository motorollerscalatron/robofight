<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('playera')->unsigned();
            $table->integer('playerb')->unsigned();
            $table->integer('winner')->unsigned();

            $table->foreign('playera')->references('id')->on('robots');
            $table->foreign('playerb')->references('id')->on('robots');            
            $table->foreign('winner')->references('id')->on('robots');            

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
        Schema::dropIfExists('histories');
    }
}
