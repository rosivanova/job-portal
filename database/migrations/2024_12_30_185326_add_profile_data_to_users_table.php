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
        Schema::table('users', function (Blueprint $table) {
            $table->string('cv',200)->default('No CV')->after('password');
            $table->string('job_title',200)->default('No job title')->after('cv');
            $table->string('bio',200)->default('No bio')->after('job_title');
            $table->string('twitter',200)->default('No twitter')->after('bio');
            $table->string('facebook',200)->default('No facebook')->after('twitter');
            $table->string('linkedin',200)->default('No linkedin')->after('facebook');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('cv');
            $table->dropColumn('job_title');
            $table->dropColumn('bio');
            $table->dropColumn('twitter');
            $table->dropColumn('facebook');
            $table->dropColumn('linkedin');
        });
    }
};
