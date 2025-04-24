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
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar'); // Arabic name
        $table->string('name_en'); // English name
        $table->unsignedBigInteger('mission_owner');
        $table->unsignedBigInteger('profissionalist_id');
        $table->foreign('mission_owner')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('profissionalist_id')->references('id')->on('users')->onDelete('cascade');

        $table->foreignId('mission_id')->constrained()->onDelete('cascade'); // Foreign key to mission_id
        $table->integer('rate')->nullable(); // Rate field
        $table->text('comment')->nullable(); // Comment field
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
