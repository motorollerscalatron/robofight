<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWlratioTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER tr_upd_wl  BEFORE UPDATE ON wlratios
            FOR EACH ROW
            BEGIN
              IF NEW.updated_at <> OLD.updated_at THEN
                  SET NEW.ratio = new.win / (new.win + new.lose);
              END IF;
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
        DB::unprepared('DROP TRIGGER `tr_upd_wl`');
    }
}
