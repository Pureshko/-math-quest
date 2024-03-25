<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submissions;
use App\Models\Problems;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    //
    public function index(){
        $submissions = Submissions::join('users', 'users.id', '=', 'submissions.user_id')
            ->join('problems', 'problems.id', '=', 'submissions.problem_id')
            ->orderBy('submissions.created_at', 'desc')
            ->select(
                'submissions.id',
                'problems.title',
                'users.team_name',
                'submissions.correct',
                'submissions.score',
            )
            ->get();
        return view('teams.submission', ['submissions' => $submissions]);
    }

    public function submitAnswer(Request $request){
        $request->validate([
            "problem_id" => "required|exists:problems,id",
            'answer' => 'required|string'
        ]);
        $user_id = Auth::id();
        $problem = Problems::find($request->problem_id);
        $correct = 0;
        $score = 0;
        if($request->answer == $problem->answer){
            $correct = 1;
            $score = $problem->weight;
        }else{
            $score = -50;
        }
        Submissions::create([
            'user_id' => $user_id,
            'problem_id' => $request->problem_id,
            'answer' => $request->answer,
            'score' => $score,
            'correct' => $correct
        ]);
        return redirect()->route('problemset');
    }
}
