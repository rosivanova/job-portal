<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostedJobController;


Route::get('/', function () {
    return view('home', [HomeController::class,'index'])->name('home');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/posted-jobs', [PostedJobController::class, 'index'])->name('posted.jobs');
