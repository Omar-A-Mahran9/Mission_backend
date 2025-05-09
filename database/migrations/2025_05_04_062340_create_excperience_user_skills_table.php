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
        Schema::create('excperience_user_skills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('excperience_user_id');
            $table->foreign('excperience_user_id')->references('id')->on('excperience_users')->cascadeOnDelete();
            $table->unsignedBigInteger('skill_id');
            $table->foreign('skill_id')->references('id')->on('skills')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excperience_user_skills');
    }
};
