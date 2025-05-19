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
        Schema::create('mission_attachments', function (Blueprint $table) {
            $table->id(); // UniqueID (PK)
            $table->foreignId('mission_id')->constrained()->onDelete('cascade'); // FK to missions
            $table->string('file'); // File path or name
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_attachments');
    }
};
