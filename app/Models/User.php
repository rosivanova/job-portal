<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
// use MfaToken; // Remove this line if it exists
use App\Models\MfaToken; // Add this line

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_image',
        'cv',
        'job_title',
        'bio',
        'twitter',
        'facebook',
        'linkedin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin()
    {
        return $this->is_admin; // assuming 'is_admin' is a boolean field in your users table
    }

    public function sendMfaToken(User $user)
{
    $token = Str::random(40);
    $expiresAt = now()->addMinutes(10);

    MfaToken::create([
        'user_id' => $user->id,
        'token' => $token,
        'expires_at' => $expiresAt,
    ]);

    $verificationUrl = route('mfa.verify', ['token' => $token]);

    Mail::send('emails.mfa', ['url' => $verificationUrl], function ($message) use ($user) {
        $message->to($user->email);
        $message->subject('Your MFA Verification Link');
    });
}


}
