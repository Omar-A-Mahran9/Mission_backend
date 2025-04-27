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
        Schema::create('mission_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mission_id')->constrained()->onDelete('cascade'); // Foreign key for mission
            $table->foreignId('skill_id')->constrained()->onDelete('cascade');   // Foreign key for skill
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_skills');
    }
};
