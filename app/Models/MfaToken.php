<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MfaToken extends Model
{
    protected $fillable = [
        'user_id',
        'token',
        'expires_at'   
    ];
}
