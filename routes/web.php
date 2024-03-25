<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProblemSetController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\SubmissionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login',[LoginController::class, 'index'])->name('login.page');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'indexRegister'])->name('register.page');
Route::post('/register', [LoginController::class, "register"])->name('register');
Route::middleware("auth")->group(function(){
    Route::get("/", function(){
        return view('main-page')->with('page', 'main-page');
    })->name("main-page");
    Route::get("/problemset", [ProblemSetController::class, 'index'])->name("problemset");
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');
    Route::prefix('problem')->group(function(){
        Route::get("/{id}", [ProblemSetController::class, 'problem'])->name("problem");
        Route::post("/submit", [SubmissionController::class, 'submitAnswer'])->name("problem.submit");
    });
    Route::prefix("/submissions")->group(function(){
        Route::get('/',[SubmissionController::class, 'index'])->name('submissions');
    });
});
