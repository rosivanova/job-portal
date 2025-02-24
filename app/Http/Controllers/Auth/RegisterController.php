<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function register(Request $request)
    {
        // dd($request->all());
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());

        // event(new Registered($user = $this->create($request->all())));

        // Log the user in after successful registration
        if ($user) {
            // Auth::login($user);
            return redirect(route('login'))->with('success', 'Registration successful. Please login to continue.');
        }
        else{
            return redirect(route('register'))->with('error', 'Registration failed. Please try again.');
        }
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'] ?? 'No image', // Validate image if provided

        ]);

        // Handle profile picture upload (if exists)
        if ($request->hasFile('user_image')) {
            $imagePath = $request->file('user_image')->store('user_image', 'public');
        } else {
            // If no image is uploaded, use the default image path
            $imagePath = 'images/default_profile.jpg';
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_image' => 'default.jpg',
        ]);
    }
    //dd($data);
}
