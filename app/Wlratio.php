<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wlratio extends Model
{
    protected $fillable = ['robot_id', 'fight', 'win', 'lose'];
    
}
