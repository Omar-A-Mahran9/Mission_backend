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
        Schema::create('offer_logs', function (Blueprint $table) {
            $table->id();
                $table->foreignId('offer_id')->constrained()->onDelete('cascade');
                $table->foreignId('offer_status_id')->constrained('status');
                $table->timestamp('offer_action_at')->nullable();
                $table->foreignId('user_id')->constrained('users');
                $table->foreignId('mission_id')->constrained('missions');
                $table->enum('role', [1, 2])
                ->comment('1: Client, 2: Freelancer');




                // $table->foreignId('client_confirmed')->constrained('status');

                // $table->timestamp('client_action_at')->nullable();
                // $table->foreignId('client_id')->constrained('users');

                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_logs');
    }
};
