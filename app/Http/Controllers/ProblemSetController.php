<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Problems;
use App\Models\Submissions;
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
                    (SELECT COUNT(*) FROM submissions WHERE problem_id = problems.id AND user_id = ".$user_id." AND correct = 1) > 0,
                    1,
                    0
                ) as solved
            ")
        )
            ->get();
        $submissions = Submissions::where('user_id', $user_id)
            ->join('problems', 'problems.id', '=', 'submissions.problem_id')
            ->orderBy('created_at', 'desc')
            ->select(
                'submissions.id',
                'problems.title',
                'submissions.correct',
                'submissions.score',
            )
            ->get();
        return view('problems.problemset', [
            'problems' => $problems,
            'submissions' => $submissions
        ]);
    }
    public function problem(Request $request, $id){
        $problem = Problems::find($id);
        $submissions = Submissions::where('problem_id', $id)
            ->where('user_id', Auth::id())
            ->join('problems', 'problems.id', '=', 'submissions.problem_id')
            ->orderBy('created_at', 'desc')
            ->select(
                'submissions.id',
                'problems.title',
                'submissions.correct',
                'submissions.score',
            )
            ->get();
        $problem_choices = Problems::select('id','title')->get();
        return view('problems.'.$id, [
            'problem' => $problem,
            'submissions' => $submissions,
            'problem_choices' => $problem_choices
        ]);
    }
    

}
