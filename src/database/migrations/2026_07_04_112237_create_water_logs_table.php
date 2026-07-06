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
        Schema::create('water_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->date('record_date');
            $table->unsignedSmallInteger('weight_kg');
            $table->unsignedSmallInteger('height_cm')->nullable();
            $table->enum('activity_level', ['ringan', 'sedang', 'berat']);
            $table->unsignedInteger('calculated_requirement_ml');
            $table->unsignedInteger('actual_intake_ml')->default(0);
            $table->enum('hydration_status', ['cukup', 'kurang'])->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'record_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('water_logs');
    }
};