<?php

namespace App\Models;


use Database\Factories\PostedJobFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JobCategory;

class PostedJob extends Model
{
    use HasFactory;

    protected $table = 'posted_jobs';
    

    protected $casts = [
        'application_deadline' => 'date:d/m/Y',
    ];

    public function getApplicationDeadlineAttribute($value)
    {                                                                                                                                                                                                                                                           
        return \Carbon\Carbon::parse($value)->format('d/m/Y');
    }

    protected $fillable = [
        'id',
        'job_title',
        'company',
        'job_region',
        'job_type',
        'vacancy',
        'experience',
        'salary',
        'gender',
        'application_deadline',
        'job_description',
        'responsibilities',
        'education_experience',
        'other_benefits',
        'job_image',
        'jobcategory_id'
    ];

    public $timestamps = true;


    protected static function newFactory()
    {
        return PostedJobFactory::new();
    }

    public function jobCategory()
    {
        // return $this->belongsTo(JobCategory::class);
        return $this->belongsTo(JobCategory::class, 'jobcategory_id');

    }
}
