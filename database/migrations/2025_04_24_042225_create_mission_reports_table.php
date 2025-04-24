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
        Schema::create('mission_reports', function (Blueprint $table) {
            $table->id();
            $table->id(); // PK
            $table->unsignedBigInteger('report_id');
            $table->unsignedBigInteger('mission_id');
            $table->unsignedBigInteger('user_id');
            $table->text('details');
            $table->timestamps(); // created_at, updated_at

            // Foreign Keys
            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');
            $table->foreign('mission_id')->references('id')->on('missions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_reports');
    }
};
