<?php

namespace Database\Seeders;

//use App\Models\Job\Job;
use App\Models\PostedJob;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostedJob::factory()
        ->count(50)
        ->create();
    }
}
