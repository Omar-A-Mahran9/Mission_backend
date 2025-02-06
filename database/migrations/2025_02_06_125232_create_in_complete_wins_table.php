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
        Schema::create('in_complete_wins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bids_id'); // Reference to bids
            $table->unsignedBigInteger('bids_users_id'); // User who won the bid
            $table->unsignedBigInteger('bids_Products_id'); // Product won

            // Foreign Key Constraints
            $table->foreign('bids_id')->references('id')->on('bids')->onDelete('cascade');
            $table->foreign('bids_users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bids_Products_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('in_complete_wins');
    }
};
