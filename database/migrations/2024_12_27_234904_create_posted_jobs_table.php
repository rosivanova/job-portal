<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posted_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('job_title');
            $table->string('company');
            $table->string('job_region');
            $table->string('job_type');
            $table->string('vacancy');
            $table->string('experience');
            $table->float('salary');
            $table->string('gender');
            $table->date('aplication_deadline');
            $table->text('job_description');
            $table->text('responsibilities');
            $table->text('education_experience');
            $table->text('other_benefits');
            $table->text('job_image');
            $table->string('jobcategory_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posted_jobs');
    }
};
