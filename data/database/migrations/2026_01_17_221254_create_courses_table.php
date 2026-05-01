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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_code', 15)->nullable()->unique();
            $table->string('course_name', 100)->nullable();
            $table->foreignId('prodi_id')->constrained('study_programs')->onDelete('cascade');
            $table->integer('semester')->unsigned()->nullable();
            $table->integer('sks_teori')->unsigned()->nullable();
            $table->integer('sks_praktik')->unsigned()->nullable();
            $table->integer('status')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
