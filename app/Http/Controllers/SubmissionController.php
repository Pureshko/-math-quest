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
        return view('teams.submission');
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
