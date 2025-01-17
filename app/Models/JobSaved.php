<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobSaved extends Model
{
    protected $table = 'job_saved';
    protected $fillable = [
        'job_id',
        'user_id',
        'job_image',
        'job_title',
        'job_region',
        'job_type',
        'company'
    ];

    public $timestamps = true;
}
