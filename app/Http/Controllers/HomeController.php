<?php

namespace App\Http\Controllers;

use App\Models\PostedJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // if (!Auth::check()) {
        //     // Redirect if the user is not authenticated
        //     return redirect()->route('login')->with('error', 'You need to be logged in to apply for a job.');
        // }

        $jobs = PostedJob::select()->take(5)->orderBy('id', 'desc')->get();
        $totalJobs = PostedJob::all()->count();
        $jobRegions = PostedJob::distinct()->pluck('job_region');
        $jobTypes = PostedJob::distinct()->pluck('job_type');
        $duplicates = DB::table('searches')
        ->select('keyword', DB::raw('COUNT(*) as count'))
        ->groupBy('keyword')
        ->havingRaw('COUNT(*) > 1')
        ->orderBy('count', 'asc')
        ->take(3)
        ->get()
        ->pluck('keyword');
        
    //   dd($jobs,$totalJobs,$jobRegions,$jobTypes, $duplicates);
        return view('home', compact('jobs', 'totalJobs', 'jobRegions', 'duplicates','jobTypes'));
    }
}
