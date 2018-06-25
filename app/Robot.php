<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Robot extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','weight','power','speed','avatar'];
    //
    public function user()
    {
        return $this->belongsTo('App\User', 'owner_id');
    }

    public function wlratio()
    {
        return $this->hasOne('App\Wlratio', 'robot_id');
    }

    protected $dates = ['deleted_at'];

}
