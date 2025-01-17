<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostedJobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /* Job Title*/
        $position = ['PHP Developer', 'Java Developer', 'Vue Developer','Wordpress Developer','Azzure Developer','System Admin','Magento'];
        $position_key = array_rand($position);

        /* Job Type */
        $job_type = ['Part Time', 'Full time'];
        $job_type_key = array_rand($job_type);

        /* Gender*/
        $gender_type = ['Male', 'Female', 'All'];
        $gender_type_key = array_rand($gender_type);


    

        return [
            'job_title' => $position[$position_key],
            'company' => fake()->company(),
            'job_region' => fake()->city(),
            'job_type' => $job_type[$job_type_key],
            'vacancy' => rand(1, 3),
            'experience' => fake()->name(),
            'salary' => rand(5000, 10000),
            'gender' => $gender_type[$gender_type_key],
            'aplication_deadline' => fake()->date(),
            'job_description' => fake()->word(50),
            'responsibilities' => Str::random(10),
            'education_experience' => Str::random(10),
            'other_benefits' => Str::random(10),
            //'job_image' => fake()->image('640','480',null,true,true,null,null,false,'png'),
            'job_image' => Str::random(50),
            'jobcategory_id'=> rand(1, 10)
        ];
    }
}
