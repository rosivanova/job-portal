<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
use App\Models\PostedJob;
use App\Models\JobCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    use WithoutModelEvents;

    public function run(): void
    {
        // User::factory(10)->create();
        PostedJob::factory(100)->create();
        JobCategory::factory(10)->create();

        // $this->call([
        //     PostedJobSeeder::class,
        // ]);
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call(AdminSeeder::class); 
    }
}
