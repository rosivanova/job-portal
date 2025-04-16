<?php

namespace App\Http\Controllers;

use App\Models\MfaToken;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MfaController extends Controller
{
    public function verify($token)
    {
        $mfaToken = MfaToken::where('token', $token)->first();

        if (!$mfaToken || $mfaToken->expires_at < now()) {
            return redirect('/login')->withErrors(['message' => 'Invalid or expired MFA token.']);
        }

        // Mark the device as trusted or log the user in
        // For example:
        Auth::loginUsingId($mfaToken->user_id);

        // Delete the token after successful verification
        $mfaToken->delete();

        if(Auth::user()->is_admin) {
            return redirect('/admin/dashboard')->with('status', 'MFA verified successfully. Welcome back!');
        }elseif(Auth::user()->is_user) {
            return redirect('/profile')->with('status', 'MFA verified successfully. Welcome back!');
        }else{
            return redirect('/home')->with('errror', 'ERROR!');
        }
        // return redirect('/home')->with('status', 'MFA verified successfully. Welcome back!');
        // return redirect('/admin/dashboard')->with('status', 'Device trusted successfully.');
    }
}

