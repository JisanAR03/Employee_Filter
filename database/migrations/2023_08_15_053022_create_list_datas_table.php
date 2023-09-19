<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('list_datas', function (Blueprint $table) {
            // $table->string('list_name',200);
            $table->unsignedBigInteger('list_id')->nullable(false);
            $table->unsignedBigInteger('resume_id')->nullable(false);
            $table->foreign('resume_id')->references('id')->on('resumes')->onDelete('cascade');
            $table->foreign('list_id')->references('id')->on('lists')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_datas');
    }
};
