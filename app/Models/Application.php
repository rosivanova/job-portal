<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Application extends Model
{
    use HasFactory;

    protected $table = 'applications';

    protected $fillable = [
        'cv',
        'job_id',
        'email',
        'user_id',
        'job_image',
        'job_title',
        'job_region',
        'company',
        'job_type'
    ];

    public $timestamps = true;

    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }
    
}
