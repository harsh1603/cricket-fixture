<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class WebController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('web.home');
    }

    public function teams()
    {
        $teams = DB::table ( 'cricket_teams' )
		->orderBy ( 'cricket_teams.name', 'asc' )
		->get();
        return view('web.teams', compact('teams'));
    }
    public function teamPlayer($team_id)
    {
        $player = DB::table ( 'cricket_players' )
        ->where('team_id',$team_id)->get();
        return view('web.player', compact('player'));
    }
    public function teammatch()
    {
        $match = DB::table ( 'cricket_match' )
        ->get();
        return view('web.match', compact('match'));
    }
    public function points()
    {
        $points = DB::table ( 'cricket_points' )->select("team_id",DB::raw('SUM(played) AS played'),DB::raw('SUM(match_tied) AS match_tied'),DB::raw('SUM(match_won) AS match_won'),DB::raw('SUM(match_lose) AS match_lose'),DB::raw('SUM(points) AS points'))
        ->groupBy('team_id')->get();
   
        return view('web.points', compact('points'));
    }
}
