<?php

namespace App\Http\Controllers\Users;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\PostedJob;
use App\Models\User;
use App\Models\JobSaved;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;




class UsersController extends Controller
{
    public function profile(Request $request)
    {
        
        // $user = Auth::user();
        // $profile = User::find($user->id);
        // dd($profile);
        // $profile = User::find(Auth::user()->id);
        // dd($profile);
    
        //$profile = User::find(Auth::user()->id);
        $appliedJobs = Application::where('user_id', '=', Auth::user()->id)
            ->join('posted_jobs', 'applications.job_id', '=', 'posted_jobs.id')
            ->select('applications.*', 'posted_jobs.*')
            ->get();
        
        //dd($appliedJobs);
        $savedJobs = JobSaved::where('user_id', '=', Auth::user()->id)
            ->count();
        $appliedJobsCount = Application::where('user_id', '=', Auth::user()->id)
            ->count();
        $profile=User::find($request->user()->id);
        return view('pages.profile', compact('profile','appliedJobs','savedJobs','appliedJobsCount'));
    }

    public function applications()
    {
        $applications = Application::where('user_id', '=', Auth::user()->id)
            ->get();
        // dd($applications);
        return view('users.applications', compact('applications'));
    }

    public function savedJobs()
    {
        $savedjobs = JobSaved::where('user_id', '=', Auth::user()->id)
            ->get();

        return view('users.savedjobs', compact('savedjobs'));
    }

    public function editDetails()
    {
        $userDetails = User::find(Auth::user()->id);

        return view('users.editdetails', compact('userDetails'));
    }

    public function updateDetails(Request $request)
    {

        Request()->validate([
            'name' =>"required|max:40",
            'job_title' =>"required|max:40",
            'bio' =>"required|max:140",
            'facebook' =>"required|max:140",
            'facebook' =>"required|max:140",
            'linkedin' =>"required|max:140",
        ]);

        $userDetailsUpdate = User::find(Auth::user()->id);

        $userDetailsUpdate->update([
            'name' => $request->name,
            'job_title' => $request->job_title,
            'bio' => $request->bio,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
        ]);


        if ($userDetailsUpdate) {

            return redirect('/users/edit-details/')->with('update', 'Profile successfully updated');
        }
    }

    public function editCV(Request $request)
    {

        return view('users.editcv');
    }

    public function updateCV(Request $request)
    {

        Request()->validate([
            'cv' =>"required",
        ]);

        $user = User::find(Auth::user()->id);
        $mycv = $request->cv->getClientOriginalName();



        // Validate the uploaded file
        $validator = Validator::make($request->all(), [
            'cv' => 'required|file|mimes:pdf,doc,docx|max:10240',  // Validates file types and max size (in KB)
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        if ($user->cv) {
            if (Storage::disk('public')->exists('assets/cvs/' . $user->cv)) {
                Storage::disk('public')->delete('assets/cvs/' . $user->cv);
            }
        }



        if ($request->hasFile('cv') && $request->file('cv')->isValid()) {
            // Get the file from the request
            $file = $request->file('cv');

            $fileName = $file->getClientOriginalName();

            // Store the file in the 'public/cvs' directory using the public disk
            $filePath = $file->storeAs('assets/cvs', $fileName, 'public');

            // // Update the user's CV field with the new file name
            $user->update([
                'cv' => $mycv
            ]);
        }



        // if(!empty($oldCV->cv)){
        //     if (Storage::disk('cvs')->exists($oldCV->cv)) {
        //         Storage::disk('cvs')->delete($oldCV->cv);



        //         $oldCV->update([
        //             'cv' => $mycv
        //         ]);
        //     }


        // }


        // if (Storage::disk('cvs')->exists($oldCV->cv)) {
        //     // dd('yes');
        //     Storage::disk('cvs')->delete($oldCV->cv);
        // }



        // Redirect back with a success message
        return redirect('/users/profile')->with('update', 'CV successfully updated');
    }
}
