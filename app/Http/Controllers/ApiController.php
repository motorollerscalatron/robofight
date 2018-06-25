<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Robot;
use App\History;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiController extends Controller
{

    /**
     * Display the last 5 history entries
     *
     * @return \\Illuminate\\Http\\Response
     */
    public function history()
    {
        $histories= History::orderBy("id", "desc")->take(5)->get();
        return \Response::json($histories);
    }

    /**
     * Display top 10 robots
     *
     * @return \\Illuminate\\Http\\Response
     */
    public function topRobots()
    {
        $robots = DB::table('robots')
            ->join('wlratios', 'robots.id', '=', 'wlratios.robot_id')
            ->orderBy('win', 'desc')
            ->limit(10)
            ->get();
        return \Response::json($robots);
    }
}
