<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProblemSetController;
use App\Http\Controllers\ProblemController;

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
        return view('main-page');
    })->name("main-page");
    Route::get("/problemset", "ProblemSetController@index")->name("problemset");
    Route::prefix('problem')->group(function(){
        Route::get("/{id}", "ProblemSetController@problem")->name("problem");
        Route::post("/submit", "ProblemSetController@submitAnswer")->name("problem.submit");
    }); 
});
