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
        Schema::create('web_configs', function (Blueprint $table) {
            $table->id();
            $table->string('department', 50)->nullable();
            $table->string('department_leader', 50)->nullable();
            $table->string('department_leader_nip', 25)->nullable();
            $table->string('institution', 50)->nullable();
            $table->string('ministry', 100)->nullable();
            $table->text('storage_path')->nullable();
            $table->text('absolute_path')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_configs');
    }
};
