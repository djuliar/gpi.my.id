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
        Schema::create('learning_plans', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id')->unsigned()->nullable();
            $table->json('lecturer')->nullable();
            $table->string('launch_city', 50)->nullable();
            $table->date('launch_date')->nullable();
            $table->string('course_coordinator', 100)->nullable();
            $table->string('course_coordinator_nip', 25)->nullable();
            $table->string('author', 100)->nullable();
            $table->string('author_nip', 25)->nullable();
            $table->text('introduction')->nullable();
            $table->json('cpl')->nullable();
            $table->json('tb')->nullable();
            $table->text('description')->nullable();
            $table->text('material')->nullable();
            $table->text('reference')->nullable();
            $table->json('prerequisite_course')->nullable();
            $table->json('additional_page')->nullable();
            $table->text('note')->nullable();
            $table->integer('status')->unsigned()->nullable()->default(1);
            $table->integer('user_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_plans');
    }
};
