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
        Schema::create('work_book_events', function (Blueprint $table) {
            $table->id();
            $table->integer('event_to')->unsigned()->nullable()->default(1);
            $table->string('title', 50)->nullable();
            $table->string('main_topic', 100)->nullable();
            $table->string('weeks', 50)->nullable();
            $table->string('class_name', 50)->nullable();
            $table->integer('time_allocation')->unsigned()->nullable();
            $table->text('cpmk')->nullable();
            $table->json('bnsp')->nullable();
            $table->text('indicator')->nullable();
            $table->json('basic_theory')->nullable();
            $table->text('tool_material')->nullable();
            $table->json('procedure')->nullable();
            $table->text('result')->nullable();
            $table->text('conclusion')->nullable();
            $table->json('assessment_rubric')->nullable();
            $table->integer('status')->unsigned()->nullable()->default(1);
            $table->integer('page_number')->unsigned()->nullable()->default(1);
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('bkpm_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_book_events');
    }
};
