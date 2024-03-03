<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Problems;
use App\Models\SolvedProblems;
use Illuminate\Support\Facades\Auth;
//use DB class
use Illuminate\Support\Facades\DB;
//use Hash class
use Illuminate\Support\Facades\Hash;

class ProblemSetController extends Controller
{
    //
    public function index(){
        $user_id = Auth::id();
        $problems = Problems::select(
            'id',
            'title',
            DB::raw("
                IF(
                    (SELECT COUNT(*) FROM solved_problems WHERE problem_id = problems.id AND user_id = ".$user_id." AND correct = 1) > 0,
                    1,
                    0
                ) as solved
            ")
        )
            ->get();
        return view('layout.problemset', [
            'problems' => $problems
        ]);
    }
    public function problem(Request $request, $id){
        return view('problems.'.$id);
    }
    public function getSubmissionAttemps(Request $request){
        $request->validate([
            "problem_id" => "required|exists:problems,id"
        ]);
        $user_id = Auth::id();
        $problem_id = $request->problem_id;
        $attempts = SolvedProblems::select(
                'id',
                'score',
                'correct',
                'created_at'
            )
            ->where('user_id', $user_id)
            ->where('problem_id', $problem_id)
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json([
            'attempts' => $attempts
        ]);
    }
    public function submitAnswer(Request $request){
        $request->validate([
            "problem_id" => "required|exists:problems,id",
            'answer' => 'required|string'
        ]);
        $user_id = Auth::id();
        $problem = Problems::find($request->problem_id);
        $correct = 0;
        if(Hash::check($request->answer, $problem->answer)){
            $correct = 1;
        }
        SolvedProblems::create([
            'user_id' => $user_id,
            'problem_id' => $request->problem_id,
            'score' => $problem->weight,
            'correct' => $correct
        ]);
        return redirect()->route('problemset');
    }

}
