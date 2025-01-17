<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobCategory;
use App\Models\PostedJob;

class CategoriesController extends Controller
{
    public function singleCategory($name)
    {


        // Find the category by name
        $category = JobCategory::where('name', $name)->first();
//dd($name, $category);
        if ($category) {
            $jobs = PostedJob::where('jobcategory_id', $category->id) // Use the category's ID
                             ->take(5)
                             ->orderby('created_at', 'desc')
                             ->get();
        } else {
            // If category doesn't exist, return an error or an empty set
            $jobs = collect();  // empty collection
        }
 
        return view('categories.single', compact('jobs', 'category','name')); // Pass category as well
    }
}
