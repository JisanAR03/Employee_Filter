<?php

use Illuminate\Support\Facades\DB;
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
        Schema::table('resumes', function (Blueprint $table) {
            $table->string('last_engagement_date', 50)->nullable()->default(DB::raw('now()'))->after('id');
            $table->string('salary', 50)->nullable()->after('work_experience');
            $table->text('notes')->nullable()->after('location');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resumes', function (Blueprint $table) {
            //
        });
    }
};
