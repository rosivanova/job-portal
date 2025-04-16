<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostedJobController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MfaController;
use App\Http\Controllers\Users\UsersController;


/* Test mail sending */
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

Route::get('/send-test-email', function () {

    Mail::to('rosivanova@abv.bg')->send(new TestEmail());

    return 'Test email sent!';

});


Route::auth(['verify' => true]); 

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/mfa/verify/{token}', [MfaController::class, 'verify'])->name('mfa.verify');


// Auth::routes(['verify' => true]);

// Route::get('/', function () {
//     return view('home', [HomeController::class, 'index'])->name('home');
// });

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/profile', [UsersController::class,'profile'])->name('profile'); 
Route::get('/profile/edit', function () {
    return view('pages.editProfile');
})->name('edit.profile');


Route::get('/login', function () {
    return view('login'); // Return the 'login' view
})->name('login');


Route::post('/login', [LoginController::class, 'login'])->name('login.user');

Route::post('logout', function () {
    Auth::logout();
    return redirect('/');  // Redirect to the home page or any page after logging out
})->name('logout');

Route::get('/register', function () {
    return view('register'); // Return the 'register' view
})->name('register');


Route::post('/register', [RegisterController::class, 'register'])->name('register.user');


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/search', [PostedJobController::class, 'search'])->name('search');


Route::get('/admin/login', [AdminAuthController::class, 'viewLogin'])->name('admins.login');
Route::post('/admin/login', [AdminAuthController::class, 'checkLogin'])->name('admins.checklogin');
Route::get('/admin/dashboard', function () {
    if (Auth::user()->is_admin == 0) {
        return redirect()->back()->with(['error' => 'Error logging in']);
    }
    if (Auth::user()->is_admin == 1) {
         $users = User::all();
     
         return view('admins.dashboard', compact('users'));
     
    }
   // return view('admins.dashboard'); // Return the 'login' view
})->name('admins.dashboard');
// Route::get('/admin/displayUsers', [AdminAuthController::class, 'displayUsers'])->name('admins.displayUsers');





Route::name('posted-jobs.')->group(function () {
    // Route::get('/', [PostedJobController::class, 'index'])->name('posted.jobs');
    Route::get('/create', [PostedJobController::class, 'create'])->name('create');
    Route::post('/saveJob', [PostedJobController::class, 'saveJob'])->name('saveJob');
    Route::get('/{id}/edit', [PostedJobController::class, 'edit'])->name('edit');
    Route::post('/{id}/update', [PostedJobController::class, 'update'])->name('update');
    Route::get('/{id}/delete', [PostedJobController::class, 'delete'])->name('delete');
    Route::get('/posted-jobs/{id}/single', [PostedJobController::class, 'single'])->name('single');
    Route::post('/posted-jobs/{id}/apply', [PostedJobController::class, 'apply'])->name('apply');
});

Route::get('/posted-jobs/{id}/applicants', [PostedJobController::class, 'applicants'])->name('posted.jobs.applicants');
Route::get('/posted-jobs/{id}/applicants/{applicant_id}/approve', [PostedJobController::class, 'approve'])->name('posted.jobs.approve');
Route::get('/posted-jobs/{id}/applicants/{applicant_id}/reject', [PostedJobController::class, 'reject'])->name('posted.jobs.reject');
Route::get('/posted-jobs/{id}/applicants/{applicant_id}/shortlist', [PostedJobController::class, 'shortlist'])->name('posted.jobs.shortlist');
Route::get('/posted-jobs/{id}/applicants/{applicant_id}/unshortlist', [PostedJobController::class, 'unshortlist'])->name('posted.jobs.unshortlist');
Route::get('/posted-jobs/{id}/applicants/{applicant_id}/hire', [PostedJobController::class, 'hire'])->name('posted.jobs.hire');
Route::get('/posted-jobs/{id}/applicants/{applicant_id}/unhire', [PostedJobController::class, 'unhire'])->name('posted.jobs.unhire');
Route::get('/posted-jobs/{id}/applicants/{applicant_id}/fire', [PostedJobController::class, 'fire'])->name('posted.jobs.fire');
Route::get('/posted-jobs/{id}/applicants/{applicant_id}/unfire', [PostedJobController::class, 'unfire'])->name('posted.jobs.unfire');
Route::get('/posted-jobs/{id}/applicants/{applicant_id}/complete', [PostedJobController::class, 'complete'])->name('posted.jobs.complete');
Route::get('/posted-jobs/{id}/applicants/{applicant_id}/incomplete', [PostedJobController::class, 'incomplete'])->name('posted.jobs.incomplete');
// Route::get('/posted-jobs/{id}/applicants/{applicant_id}/rate', [PostedJobController::class, 'rate'])->name('posted.jobs.rate');
// Route::post('/posted-jobs/{id}/applicants/{applicant_id}/rate', [PostedJobController::class, 'rate'])->name('posted.jobs.rate');
// Route::get('/posted-jobs/{id}/applicants/{applicant_id}/review', [PostedJobController::class, 'review'])->name('posted.jobs.review');
// Route::post('/posted-jobs/{id}/applicants/{applicant_id}/review', [PostedJobController::class, 'review'])->name('posted.jobs.review');
// Route::get('/posted-jobs/{id}/applicants/{applicant_id}/message', [PostedJobController::class, 'message'])->name('posted.jobs.message');
// Route::post('/posted-jobs/{id}/applicants/{applicant_id}/message', [PostedJobController::class, 'message'])->name('posted.jobs.message');
// Route::get('/posted-jobs/{id}/applicants/{applicant_id}/report', [PostedJobController::class, 'report'])->name('posted.jobs.report');
// Route::post('/posted-jobs/{id}/applicants/{applicant_id}/report', [PostedJobController::class, 'report'])->name('posted.jobs.report');
// Route::get('/posted-jobs/{id}/applicants/{applicant_id}/block', [PostedJobController::class, 'block'])->name('posted.jobs.block');
// Route::get('/posted-jobs/{id}/applicants/{applicant_id}/unblock', [PostedJobController::class, 'unblock'])->name('posted.jobs.unblock');
// Route::get('/posted-jobs/{id}/applicants/{applicant_id}/delete', [PostedJobController::class, 'delete'])->name('posted.jobs.delete');
// Route::get('/posted-jobs/{id}/applicants/{applicant_id}/restore', [PostedJobController::class, 'restore'])->name('posted.jobs.restore');
// Route::get('/posted-jobs/{id}/applicants/{applicant_id}/destroy', [PostedJobController::class, 'destroy'])->name('posted.jobs.destroy');
// Route::get('/posted-jobs/{id}/applicants/{applicant_id}/delete', [PostedJobController::class, 'delete'])->name('posted.jobs.delete');
