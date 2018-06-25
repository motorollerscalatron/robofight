<?php

use Illuminate\Database\Seeder;

class HistoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //
         $history = new \App\History([
           'playera' => '6',
           'playerb' => '8',
           'winner' => '6',
         ]);
         $history->save();  
         
         $history = new \App\History([
           'playera' => '5',
           'playerb' => '10',
           'winner' => '5',
         ]);
         $history->save();  

         $history = new \App\History([
           'playera' => '1',
           'playerb' => '9',
           'winner' => '9',
         ]);
         $history->save();  

         $history = new \App\History([
           'playera' => '1',
           'playerb' => '8',
           'winner' => '8',
         ]);
         $history->save();  

         $history = new \App\History([
           'playera' => '2',
           'playerb' => '7',
           'winner' => '7',
         ]);
         $history->save();  

         $history = new \App\History([
           'playera' => '1',
           'playerb' => '6',
           'winner' => '1',
         ]);
         $history->save();  

    }
}
