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
        Schema::create('mission_status', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('status_id'); // Foreign key to the status table
            $table->unsignedBigInteger('mission_id'); // Foreign key to the mission table
            $table->unsignedBigInteger('user_id')->nullable(); // Foreign key to the user table (nullable)
            $table->string('reason')->nullable(); // Reason (nullable)

            // Adding foreign key constraints
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
            $table->foreign('mission_id')->references('id')->on('missions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_status');
    }
};
