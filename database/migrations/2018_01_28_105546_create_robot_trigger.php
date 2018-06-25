<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRobotTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER tr_create_robot AFTER INSERT ON robots
            FOR EACH ROW
            BEGIN
              INSERT INTO wlratios
              ( created_at,
                robot_id,
                fight,
                win,
                lose)
              VALUES
              ( NOW(),
                NEW.id,
                0,
                0,
                0);

            END;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `tr_create_robot`');
    }
}
