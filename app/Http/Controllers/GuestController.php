<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Robot;
use App\History;
use Illuminate\Http\Request;

use App\Http\Requests;

/**
 * This controller manages the public access area 
 */
  
class GuestController extends Controller
{
    public function getIndex()
    {
        $histories= History::orderBy("id", "desc")->take(5)->get();
        $robots = DB::table('robots')
            ->join('wlratios', 'robots.id', '=', 'wlratios.robot_id')
            ->orderBy('win', 'desc')
            ->limit(10)
            ->get();

        return view('shop.index', ['robots' => $robots, 'histories' => $histories]);
        
    }

}
