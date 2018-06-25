<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = ['playera','playerb', 'winner'];
    
    public function playera()
    {
        return $this->hasOne('App\Robot', 'id', 'playera');
    }

    public function playerb()
    {
        return $this->hasOne('app\Robot', 'id', 'playerb');
    }

    public function winner()
    {
        return $this->hasOne('app\Robot', 'id', 'winner');
    }

}
