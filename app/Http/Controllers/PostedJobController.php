<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PostedJob;
use Illuminate\Http\Request;
use App\Models\JobSaved;
use App\Models\Application;
use App\Models\JobCategory;
use App\Models\Search;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use user;

class PostedJobController extends Controller
{
    public function single($id)
    {
        // if (!Auth::check()) {
        //     // Redirect if the user is not authenticated
        //     return redirect()->route('login')->with('error', 'You need to be logged in to apply for a job.');
        // }

        $posted_job = PostedJob::find($id);

        $relatedJobs = PostedJob::where('jobcategory_id', $posted_job->jobcategory_id)
            ->where('id', '!=', $id)
            ->take(3)
            ->get();

        $relatedJobsCount = PostedJob::where('jobcategory_id', $posted_job->jobcategory_id)
            ->where('id', '!=', $id)
            ->take(5)
            ->count();

        $categories = DB::table('jobcategories')
            ->join('posted_jobs', 'posted_jobs.jobcategory_id', '=', 'jobcategories.id')
            ->select('jobcategories.id AS id', 'jobcategories.name AS name', DB::raw('COUNT(posted_jobs.jobcategory_id) AS total'))
            ->groupBy('posted_jobs.jobcategory_id')
            ->get();;

        if (Auth::user()) {

            $jobSaved = JobSaved::where('job_id', $id)
                ->where('user_id', Auth::user()->id)
                ->count();

            $jobApplied = Application::where('job_id', $id)
                ->where('user_id', Auth::user()->id)
                ->count();

            return view('posted-jobs.single', compact('posted_job', 'relatedJobs', 'relatedJobsCount', 'jobSaved', 'jobApplied', 'categories'));
        } else {
            $categories = JobCategory::all();
            //  dd($categories);
            return view('posted-jobs.single', compact('posted_job', 'relatedJobs', 'relatedJobsCount', 'categories'));
        }
    }

    public function saveJob(Request $request)
    {
        if (!Auth::check()) {
            // Redirect if the user is not authenticated
            return redirect()->route('login')->with('error', 'You need to be logged in to apply for a job.');
        }else{

            // protected $fillable =[

            // ]

           $posted_job = PostedJob::find($request->id);

            $saveJob = JobSaved::create(
                [
                    'job_id' => $request->id,
                    'user_id' => Auth::user()->id,
                    'job_image' => $posted_job->job_image,
                    'job_title' => $posted_job->job_title,
                    'job_region' => $posted_job->job_region,
                    'job_type' => $posted_job->job_type,
                    'company' => $posted_job->company,
                ]
            );

            if ($saveJob) {
                return redirect('posted-jobs/' . $request->id . '/single')->with('save', 'Job successfully saved');
            }
         } 
    }

    public function apply(Request $request)
    {
        // dd($request->all());
        if (!Auth::user()) {
            // Redirect if the user is not authenticated
            return redirect()->route('login')->with('error', 'You need to be logged in to apply for a job.');
        }
            // dd();
        if (Auth::user()->cv == 'No CV') {
            return redirect('posted-jobs/'. $request->id .'/single')->with('missingCV', 'Please, Upoad your CV first');
        } else {

            $jobDetails = PostedJob::find($request->id);
             //dd($jobDetails);

            $applyJob = Application::create(
                [
                    'cv' => Auth::user()->cv,
                    'job_id' => $request->id,
                    'user_id' => Auth::user()->id,
                    'email' => Auth::user()->email,
                    'job_image' => $jobDetails->job_image,
                    'job_title' => $jobDetails->job_title,
                    'job_region' => $jobDetails->job_region,
                    'job_type' => $jobDetails->job_type,
                    'company' => $jobDetails->company,
                ]
            );
        }

        if ($applyJob) {
            return redirect('posted-jobs/'. $request->id .'/single')->with('applied', 'You have applied successfully for this job');
        }
    }

    public function about()
    {
        $postedJobs = PostedJob::all()->count();

        return view('pages.about', compact('postedJobs'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function search(Request $request)
    {

        Request()->validate([
            'job_title' => "required",
            // 'job_region' =>"required",
            // 'job_type' =>"required",

        ]);

        $job_title = trim($request->job_title);
        $job_region = trim($request->job_region);
        $job_type = trim($request->job_type);


        Search::create([
            "keyword" => $request->job_title
        ]);

        $jobs = PostedJob::with('jobCategory')->orderBy('id', 'desc')->get();
        // $searches = PostedJob::with('jobCategory')->where('job_title', 'like', "%$job_title%")
        //     ->where('job_region', 'like', "%$job_region%")
        //     ->where('job_type', 'like', "%$job_type%")
        //     ->get();

        $searches = PostedJob::with('jobCategory')
            ->when($job_title, function ($query) use ($job_title) {
                return $query->where('job_title', 'like', "%$job_title%");
            })
            ->when($job_region, function ($query) use ($job_region) {
                return $query->where('job_region', 'like', "%$job_region%");
            })
            ->when($job_type, function ($query) use ($job_type) {
                return $query->where('job_type', 'like', "%$job_type%");
            })
            ->get();


        return view('pages.search', compact('searches'));
    }
}
