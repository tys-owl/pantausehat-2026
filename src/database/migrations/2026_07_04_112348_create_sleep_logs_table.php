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
        Schema::create('sleep_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->date('record_date');
            $table->unsignedTinyInteger('age_years');
            $table->dateTime('sleep_start_time');
            $table->dateTime('wake_time');
            $table->unsignedInteger('actual_duration_minutes');
            $table->unsignedInteger('ideal_requirement_minutes');
            $table->integer('sleep_debt_minutes');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'record_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sleep_logs');
    }
};
