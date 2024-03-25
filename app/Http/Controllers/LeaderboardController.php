<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
//use DB class
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    //
    public function index(){
        $teams_nu = User::join("submissions",'users.id','=','submissions.user_id')
            ->select('users.team_name', DB::raw('SUM(submissions.score) as total_score'))
            ->where('uni_id', 1)
            ->groupBy('users.team_name')
            ->orderBy('total_score', 'desc')
            ->get();
        $teams_non_nu = User::join("submissions",'users.id','=','submissions.user_id')
            ->leftJoin('universities', 'users.uni_id', '=', 'universities.id')
            ->select('users.team_name', DB::raw('SUM(submissions.score) as total_score'), 'universities.name as uni_name')
            ->where('uni_id', '!=', 1)
            ->groupBy('users.team_name')
            ->orderBy('total_score', 'desc')
            ->get();
        $teams_general = User::join("submissions",'users.id','=','submissions.user_id')
            ->leftJoin('universities', 'users.uni_id', '=', 'universities.id')
            ->select('users.team_name', DB::raw('SUM(submissions.score) as total_score'), 'universities.name as uni_name')
            ->groupBy('users.team_name')
            ->orderBy('total_score', 'desc')
            ->get();
        return view('teams.leaderboard', [
            'teams_nu' => $teams_nu,
            'teams_non_nu' => $teams_non_nu,
            'teams_general' => $teams_general
        ]);
    }
}
