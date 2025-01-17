<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminsController extends Controller
{
    public function viewLogin()
    {
        return view('admins.view-login');
    }

    public function checkLogin(Request $request)
    {
        // Check if the remember me checkbox is selected
        $remember_me = $request->has('remember_me') ? true : false;

        // Attempt to authenticate the user
        if (auth()->guard('web')->attempt(
            ['email' => $request->input("email"), 'password' => $request->input("password")],
            $remember_me
        )) {

            

            switch (Auth::user()->is_admin) {
                case '1':
                    return view('admins.index')->with('success','Successfully logged in as Admin');
                    break;
                case '0':
                    return redirect()->back()->with(['error' => 'Error logging in']);
                    break;
            }
        }
    }

    public function index()
    {

        return view('admins.index');
    }
}
