<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\MfaToken;
use App\Models\User;
use App\Mail\FactorEmail;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {
        // $credentials = $request->only('email', 'password');

        // if (Auth::attempt($credentials)) {
        //     return redirect()->route('admins.dashboard')->with('success', 'Successfully logged in as Admin');
        //     //return redirect('admins/dashboard')->with('success', 'Successfully logged in as Admin');
        //     //return view('admins.index')->with('success', 'Successfully logged in as Admin');
        // }else{
        //     return redirect()->back()->with(['error' => 'Error logging in']);

        // }

        // return view('login');

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            if ($user) {
                $this->sendMfaToken($user instanceof \App\Models\User ? $user : \App\Models\User::find($user->id));
            }
            Auth::logout();

            return redirect('/login')->with('status', 'We have sent you an MFA verification link. Please check your email.');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function sendMfaToken(User $user)
    {
        $token = Str::random(40);
        $expiresAt = now()->addMinutes(10);

        if($user->id){
            
            MfaToken::create([
                'user_id' => $user->id,
                'token' => $token,
                'expires_at' => $expiresAt,
            ]);
    
            $verificationUrl = route('mfa.verify', ['token' => $token]);

            Mail::to($user->email)->send(new FactorEmail($verificationUrl));
            return redirect('/login')->with('status', 'We have sent you an MFA verification link. Please check your email.');
    
            // Mail::send('emails.mfa', ['url' => $verificationUrl], function ($message) use ($user) {
            //     $message->to($user->email);
            //     $message->subject('Your MFA Verification Link');
            // });
        }
        else{
            return redirect('/login')->withErrors(['message' => 'Invalid or expired MFA token.']);
        }

    }
}
