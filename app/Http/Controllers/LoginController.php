<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Settings;
use Illuminate\Support\Facades\Validator;
use PDO;

class LoginController extends Controller
{
    //
    public function index(){
        return view('layout.login');
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // check if user is authenticated
        if(Auth::attempt($credentials)){
            $contest_end = Settings::where('key', 'contest_end')->first()->value;
            $user = Auth::user();
            $request->session()->regenerate();
            session(['team_name' => $user->team_name]);
            session(['contest_end' => $contest_end]);
            return redirect()->route('main-page');
        }
        return back()->with('error', 'Invalid login credentials');
    }
    public function logout(){
        Auth::logout();
        session()->forget("team_name");
        return redirect()->route('login.page');
    }
    public function indexRegister(){
        $registration_end = Settings::where('key', 'registration_end')->first();
        if($registration_end && strtotime($registration_end->value) < time()){
            return view('errors.404', ['message' => 'Registration has ended']);
        }
        return view('layout.register');
    }
    public function register(Request $request){
        $registration_end = Settings::where('key', 'registration_end')->first();
        if($registration_end && strtotime($registration_end->value) < time()){
            return back()->with('error', 'Registration has ended');
        }
        $credentials = Validator::make($request->all(), [
            'team_name' => 'required|string|max:255',
            'member_name_1' => 'required|string|max:255',
            'member_name_2' => 'required|string|max:255',
            'member_name_3' => 'required|string|max:255',
            'member_name_4' => 'required|string|max:255',
            'uni_id' => 'required|exists:universities,id',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if($credentials->fails()){
            return back()->with('error', $credentials->errors()->first());
        }
        $user = User::where('email', $request->email)->first();
        if($user){
            return back()->with('error', 'Email already exists');
        }
        // create user
        $user = User::create([
            'team_name' => $request->team_name,
            'member_name_1' => $request->member_name_1,
            'member_name_2' => $request->member_name_2,
            'member_name_3' => $request->member_name_3,
            'member_name_4' => $request->member_name_4,
            'uni_id' => $request->uni_id,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        // login user
        Auth::login($user);
        return redirect()->route('main-page');
    }

}
