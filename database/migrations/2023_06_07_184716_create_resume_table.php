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
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->nullable();
            $table->string('current_position')->nullable();
            $table->string('current_company')->nullable();
            $table->longText('prev_comps_with_pos')->nullable();
            $table->string('average_stay')->nullable();
            $table->string('work_experience')->nullable();
            $table->string('location')->nullable();
            $table->string('city')->nullable();
            $table->string('resume_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};