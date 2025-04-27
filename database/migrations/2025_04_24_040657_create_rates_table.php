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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('mission_owner')->nullable();

             $table->unsignedBigInteger('profissionalist_id');
             $table->decimal('rate', 10, 2)->nullable();
             $table->foreign('mission_owner')->references('id')->on('users')->onDelete('cascade');
             $table->foreign('profissionalist_id')->references('id')->on('users')->onDelete('cascade');
             $table->foreignId('mission_id')->constrained()->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};
