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
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable()->after('password');
            $table->unsignedSmallInteger('weight_kg')->nullable()->after('jenis_kelamin');
            $table->unsignedSmallInteger('height_cm')->nullable()->after('weight_kg');
            $table->unsignedTinyInteger('age_years')->nullable()->after('height_cm');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['jenis_kelamin', 'weight_kg', 'height_cm', 'age_years']);
        });
    }
};
