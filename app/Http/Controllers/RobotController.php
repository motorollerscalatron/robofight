<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Robot;
use App\User;
use App\History;
use App\Wlratio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RobotController extends Controller
{

    /** status returned after submit */
    const FIGHT_VALID = 0;
    const FIGHT_INVALID_ROBOT_NOT_FOUND = 1;
    const FIGHT_INVALID_NO_CHALLENGE_LEFT = 2;
    const FIGHT_INVALID_ROBOT_ALREADY_CHALLENGED = 3;

    /** robot can make a limited number of challenges. */
    const CHALLENGES_MAX_PER_DAY = 5;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * list robots(robot landing page)
     */
    public function index()
    {
        $uid = Auth::id();
        $robots = User::find($uid)->robots;
        return view('robot.index', compact('robots'));
    }

    /**
     * show create robot page
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('robot.create');
    }

    /**
     * Store a newly created robot in storage from post
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $uid = Auth::id();
        $user = User::find($uid);
        $robot = new Robot([
          'name' => $request->get('name'),
          'weight' => $request->get('weight'),
          'power' => $request->get('power'),
          'speed' => $request->get('speed'),
          'avatar' => $request->get('avatar')
        ]);
        $robot->owner_id=$uid;
        $robot->save();

        return redirect('/robot');
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fight(Request $request)
    {
        $uid = Auth::id();
        $robots = User::find($uid)->robots;
        $opponents = DB::table('robots')->whereNotIn('owner_id', [$uid])->get();
        $status = self::FIGHT_VALID;
        return view('robot.fight', compact('robots', 'opponents', 'status')); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Edit the existing robot
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $robot = Robot::find($id);
        return view('robot.edit', compact('robot', 'id'));
    }

    /**
     * Update
     *
     * @param \Illuminate\Http\Request  $request
     * @param int $id robot id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $robot = Robot::find($id);
        $robot->name = $request->get('name');
        $robot->weight = $request->get('weight');
        $robot->power = $request->get('power');
        $robot->speed = $request->get('speed');
        $robot->avatar = $request->get('avatar');
        $robot->save();
        return redirect('/robot');
    }

    /**
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submitFight(Request $request)
    {
        $uid = Auth::id();
        $myrobotid = $request->get('myrobot');
        $opponentid = $request->get('opponent');        

        $myrobot = DB::table('robots')->where([
          ['owner_id', '=', $uid],
          ['id', '=', $myrobotid]
        ])
        ->get()->first();
        
        $opponent = DB::table('robots')->where([
          ['owner_id', '<>', $uid],
          ['id', '=', $opponentid]
         ])
         ->get()->first();
          
        //TODO:move logic to service/model
        $status = self::FIGHT_VALID;
        if ( !empty($myrobot) && !empty($opponent) ){
            $c = $this->getChallengesLeftToday($myrobotid); 
            if ($c == 0){
                $status = self::FIGHT_INVALID_NO_CHALLENGE_LEFT;
            }else if(!$this->isFirstFightToday($opponentid)){
                $status = self::FIGHT_INVALID_ROBOT_ALREADY_CHALLENGED;
            }else{        
                //  -- match rule: the quicker one is a winner - 
                $winner = $this->identifyWinner($myrobot, $opponent);
                $defeated = ($winner->id == $myrobot->id )?$opponent:$myrobot;
                $history = new History([
                    'playera' => $myrobot->id,
                    'playerb' => $opponent->id,
                    'winner' => $winner->id,
                ]);
                $history->save();
                DB::table('wlratios')->where('robot_id', $winner->id)->increment('win', 1, ['updated_at' => DB::raw('now()')]);
                DB::table('wlratios')->where('robot_id', $winner->id)->increment('fight');
                DB::table('wlratios')->where('robot_id', $defeated->id)->increment('lose', 1, ['updated_at' => DB::raw('now()')]);
                DB::table('wlratios')->where('robot_id', $defeated->id)->increment('fight');
            }
        }else{
           $status = self::FIGHT_INVALID_ROBOT_NOT_FOUND;
        }
        if ($status == self::FIGHT_VALID ){
          return view('robot.result', ['winner' => $winner, 'robot' => $myrobot, 'opponent' => $opponent, 'challange' => $c-1, 'history' => $history] );
        }else{
            $uid = Auth::id();
            $robots = User::find($uid)->robots;
            $opponents = DB::table('robots')->whereNotIn('owner_id', [$uid])->get();
            return view('robot.fight', compact('robots', 'opponents', 'status')); 
        }
    }

    /**
     * Destroy a robot
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $crud = Robot::find($id);
        $crud->delete();
  
        return redirect('/robot');
    }

    /**
     * create robots from uploaded csv. 
     */
    public function upload(Request $request){

        $uid = Auth::id();

        $upload=$request->file('upload-file');
        $filePath=$upload->getRealPath();
        $file=fopen($filePath, 'r');
        $header= fgetcsv($file);
        $escapedHeader=[];

        //validate
        foreach ($header as $key => $value) {
            $lheader=strtolower($value);
            $escapedItem=preg_replace('/[^a-z]/', '', $lheader);
            array_push($escapedHeader, $escapedItem);
        }

        while($columns=fgetcsv($file))
        {
           $data= array_combine($escapedHeader, $columns);
           // setting type
           foreach ($data as $key => &$value) {
            $value=($key=="name")?$value: (integer)$value;
           }

           $robot = new Robot([
             'name' => $data['name'],
             'speed' => $data['speed'],
             'weight' => $data['weight'],
             'power' => $data['power'],
             'avatar' => $data['avatar'],
           ]);
           $robot->owner_id=$uid;
           $robot->save();
        }
        return redirect('/robot');

    }

    /**
     * Get the num of challenge the robot can make today
     * @param int $robotid
     * @return int number of challenges this robot is allowed to make today
     */
    private function getChallengesLeftToday($robotid){

        $hist =  DB::table('histories')->where([
            ['playera', '=', $robotid],
            [DB::raw('DATE(created_at)'), '=', DB::raw('CURDATE()')]
          ]
          )->get()->count();
        return ($hist < self::CHALLENGES_MAX_PER_DAY)?(self::CHALLENGES_MAX_PER_DAY-$hist):0;

    }

    /**
     * Is the specified robot challanged the first time today
     * @param int $robotid
     * @return boolean true if there is no record today
     */
    private function isFirstFightToday($robotid){

        $hist = DB::table('histories')->where([
            ['playerb', '=', $robotid],
            [DB::raw('DATE(created_at)'), '=', DB::raw('CURDATE()')]
          ]
          )->get()->count();
        return ($hist == 0);
    }

    /**
     * Decide the winner
     * @param App\Robot $robota challenger
     * @param App\Robot $robotB opponent
     */
    private function identifyWinner($robota, $robotb){

        if ($robota->speed >= $robotb->speed){
            return $robota;
        }else{
            return $robotb;
        }

    }

}
