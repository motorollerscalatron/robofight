<?php

use Illuminate\Database\Seeder;

class RoboTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $robot = new \App\Robot([
            'name' => 'Colour',
            'weight' => '12',
            'power' => '10',
            'speed' => '13',
            'avatar' => '1',
            'owner_id' => '1'
        ]);
        $robot->save();

        $robot = new \App\Robot([
            'name' => 'Pendulum',
            'weight' => '12',
            'power' => '13',
            'speed' => '14',
            'avatar' => '2',
            'owner_id' => '2'
        ]);
        $robot->save();

        $robot = new \App\Robot([
            'name' => 'Begin',
            'weight' => '5',
            'power' => '10',
            'speed' => '13',
            'avatar' => '3',
            'owner_id' => '1'
        ]);
        $robot->save();

        $robot = new \App\Robot([
            'name' => 'Valerie',
            'weight' => '12',
            'power' => '10',
            'speed' => '13',
            'avatar' => '4',
            'owner_id' => '1'
        ]);
        $robot->save();

        $robot = new \App\Robot([
            'name' => 'Bird',
            'weight' => '12',
            'power' => '9',
            'speed' => '13',
            'avatar' => '5',
            'owner_id' => '2'
        ]);
        $robot->save();

        $robot = new \App\Robot([
            'name' => 'Minim',
            'weight' => '1',
            'power' => '10',
            'speed' => '13',
            'avatar' => '6',
            'owner_id' => '1'
        ]);
        $robot->save();

        $robot = new \App\Robot([
            'name' => 'Lunch Hour',
            'weight' => '17',
            'power' => '10',
            'speed' => '13',
            'avatar' => '7',
            'owner_id' => '2'
        ]);
        $robot->save();

        $robot = new \App\Robot([
            'name' => 'Black Umbrella',
            'weight' => '2',
            'power' => '2',
            'speed' => '30',
            'avatar' => '8',
            'owner_id' => '1'
        ]);
        $robot->save();

        $robot = new \App\Robot([
            'name' => 'Ominous Clouds',
            'weight' => '4',
            'power' => '9',
            'speed' => '13',
            'avatar' => '9',
            'owner_id' => '2'
        ]);
        $robot->save();

        $robot = new \App\Robot([
            'name' => 'Little Bell',
            'weight' => '4',
            'power' => '9',
            'speed' => '13',
            'avatar' => '10',
            'owner_id' => '1'
        ]);
        $robot->save();

        $robot = new \App\Robot([
            'name' => 'Hawk',
            'weight' => '4',
            'power' => '5',
            'speed' => '26',
            'avatar' => '11',
            'owner_id' => '1'
        ]);
        $robot->save();

    }
}
