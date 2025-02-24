<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\PostedJob;
use App\Models\JobCategory;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AdminAuthController extends Controller
{
    public function viewLogin()
    {
        return view('admins.view-login');
        //return view('auth.admin-login');
    }

    public function checkLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('admins.dashboard')->with('success', 'Successfully logged in as Admin');
            //return redirect('admins/dashboard')->with('success', 'Successfully logged in as Admin');
            //return view('admins.index')->with('success', 'Successfully logged in as Admin');
        }else{
            return redirect()->back()->with(['error' => 'Error logging in']);

        }

        // return back()->withErrors(['error' => 'Invalid credentials']);
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }

    public function index()
    {

        $jobs = PostedJob::select()->count() ?? '';
        $categories = JobCategory::select()->count();
        $applications = Application::select()->count();
        $admins = Admin::select()->count();


        return view('admins.index', compact('jobs', 'categories', 'applications', 'admins'));
    }


    public function admins()
    {
        $admins = Admin::all();

        return view('admins.all-admins', compact('admins'));
    }

    public function createAdmins()
    {

        return view('admins.create-admins');
    }


    public function storeAdmins(Request $request)
    {
        Request()->validate([
            'name' => "required|max:40",
            'email' => "required|max:40",
            'password' => "required",

        ]);


        $createAdmins = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);


        if ($createAdmins) {

            return redirect('admin/all-admins')->with('create', 'Admin created successfully');
        } else {

            return redirect()->back()->with(['error' => 'Error creating Admin']);
        }
    }
    public function displayCategories()
    {
        $categories = JobCategory::orderBy('id', 'desc')->get();

        return view('admins.display-categories', compact('categories'));
    }


    public function createCategory()
    {
        return view('admins.create-cats');
    }


    public function storeCategory(Request $request)
    {
        Request()->validate([
            'name' => "required|max:40",

        ]);


        $createCategory = JobCategory::create([
            'name' => $request['name'],
        ]);

        if ($createCategory) {
            return redirect('admin/display-categories')->with('create', 'Category created successfully');
        } else {
            return redirect()->back()->with(['error' => 'Category was not created']);
        }
    }



    public function editCategory($id)
    {

        $category = JobCategory::find($id);
        return view('admins.edit-cats', compact(('category')));
    }

    public function updateCategory(Request $request)
    {

        Request()->validate([
            'name' => "required|max:40",
        ]);

        $categoryDetails = JobCategory::find($request->id);

        $categoryDetails->update([
            'name' => $request->name,

        ]);


        if ($categoryDetails) {

            return redirect('/admin/display-categories/')->with('update', 'Category successfully updated');
        }
    }

    public function deleteCategory($id)
    {
        $categoryDetails = JobCategory::find($id);
        $categoryDetails->delete();

        if ($categoryDetails) {
            return redirect('/admin/display-categories/')->with('delete', 'Category successfully deleted');
        }
    }




    public function displayJobs()
    {
        //$jobs = PostedJob::all();

        $jobs = PostedJob::with('jobCategory')->orderBy('id', 'desc')->get();

        return view('admins.display-jobs', compact('jobs'));
    }




    public function createJobs()
    {
        $categories = JobCategory::all();
        return view('admins.create-jobs', compact('categories'));
    }

    public function storeJobs(Request $request)
    {
        //  dd($request);
        Request()->validate([
            'job_title' => "required",
            'company' => "required",
            'job_region' => "required",
            'job_type' => "required",
            'jobcategory_id' => "required",
            'vacancy' => "required",
            'education_experience' => "required",
            'experience' => "required",
            'salary' => "required",
            'gender' => "required",
            'application_deadline' => "required",
            'job_description' => "required",
            'responsibilities' => "required",
            'other_benefits' => "required",
        ]);


        // dd($_POST);


        // if ($request->hasFile('job_image') && $request->file('job_image')->isValid()) {

        //     // Validate the uploaded file
        //     $validator = Validator::make($request->all(), [
        //         'job_image' => 'required|file|mimes:jpg,png,jpeg|max:10240',  // Validates file types and max size (in KB)
        //     ]);
        //     // Get the file from the request
        //     $file = $request->file('job_image');

        //     $fileName = $file->getClientOriginalName();
        //     dd( $fileName );

        //     // Store the file in the 'public/cvs' directory using the public disk
        //     $filePath = $file->storeAs('assets/job_images', $fileName, 'public');

        //     // // Update the user's CV field with the new file name
        //     // $user->update([
        //     //     'job_image' => $mycv
        //     // ]);
        // }

        if ($request->file('job_image')) {

            $file = $request->file('job_image');

            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('assets/job_images', $fileName, 'public');
        } else {
            $fileName = 'default.png';
        }

        $createJob = PostedJob::create([
            'job_title' => $request->job_title,
            'company' => $request->company,
            'job_region' => $request->job_region,
            'job_type' => $request->job_type,
            'vacancy' => $request->vacancy,
            'education_experience' => $request->education_experience,
            'experience' => $request->experience,
            'salary' => $request->salary,
            'gender' => $request->gender,
            'application_deadline' => $request->application_deadline,
            'job_description' => $request->job_description,
            'responsibilities' => $request->responsibilities,
            'other_benefits' => $request->other_benefits,
            'job_image' => $fileName,
            'jobcategory_id' => $request->jobcategory_id,
        ]);

        if ($createJob) {

            return redirect('admin/display-jobs')->with('create', 'Job created successfully');
        } else {

            return redirect()->back()->with(['error' => 'Error creating Job']);
        }
    }

    public function editJob($id)
    {

        $job = PostedJob::find($id);
        return view('admins.edit-jobs', compact('job'));
    }

    public function deleteJob($id)
    {


        $job = PostedJob::find($id);

        if ($job->job_image) {
            if (Storage::disk('public')->exists('assets/job_images/' . $job->job_image)) {
                Storage::disk('public')->delete('assets/job_images/' . $job->job_image);
            }
        } else {
            dd('File does not exist');
        }

        $job->delete();

        if ($job) {
            return redirect('/admin/display-jobs/')->with('delete', 'Job successfully deleted');
        }
    }

    public function displayApplications()
    {
        $applications = Application::all();
        // $applications = Application::with('users')->where('id', $job_id)->get();


        return view('admins.display-applications', compact('applications'));
    }

    public function deleteApplications(Request $request, $id)
    {
        $deleteApplication = Application::find($id);


        $deleteApplication->delete();

        if ($deleteApplication) {
            return redirect('admin/display-applications')->with('delete', 'Application successfully deleted');
        }
    }

    public function displayUsers()
    {
        $users = User::orderBy('id','desc')->get();
        // $applications = Application::with('users')->where('id', $job_id)->get();


        return view('admins.all-users', compact('users'));
    }

    public function createUsers()
    {

        return view('admins.create-users');
    }

    public function storeUsers(Request $request)
    {

        // Validate the input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',  // Ensure email is unique in users table
            'name'  => 'required|string|max:255',
            'password' => 'required|string|min:8',  // Assumsing password confirmation with (confirmed)
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        $userAdded = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => bcrypt($request->password),
        ]);


        if ($userAdded) {

            return redirect('admin/display-users')->with('create', 'User added successfully');
        } else {

            return redirect()->back()->with(['error' => 'Error creating Admin']);
        }
    }
}
