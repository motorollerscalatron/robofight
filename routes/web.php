<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'GuestController@getIndex');

Auth::routes();

Route::post('robot/upload', 'RobotController@upload');
Route::get('robot/fight', [
    'as' => 'robot.fight',
    'uses' =>'RobotController@fight',
]
);
Route::post('robot/submitFight', [
    'as' => 'robot.submit',
    'middleware' => 'csrf',
    'uses' => 'RobotController@submitFight',
]);
Route::resource('robot', 'RobotController');
