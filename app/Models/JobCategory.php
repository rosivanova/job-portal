<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\JobCategoryFactory;
use App\Models\PostedJob;

class JobCategory extends Model
{
   use HasFactory;

   protected $table = 'jobcategories';
   protected $fillable = [
    'id',
    'name',
   ];

   public $timestamps = true;


   protected static function newFactory()
   {
       return JobCategoryFactory::new();
   }


   public function jobs()
   {
       return $this->hasMany(PostedJob::class);
   }
}
