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
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->unsignedBigInteger('field_id');
            $table->unsignedBigInteger('specialist_id');
            $table->decimal('budget', 10, 2);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('payment_way_id');
            $table->integer('days_until_delivery')->nullable();
            $table->timestamp('delivery_time');
            $table->boolean('is_publish')->default(false);
            $table->boolean('available_attachment')->default(false);

            $table->unsignedBigInteger('city_id');
            $table->timestamps();

            $table->foreign('field_id')->references('id')->on('fields')->onDelete('cascade');
            $table->foreign('specialist_id')->references('id')->on('specialists')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('payment_way_id')->references('id')->on('payment_ways')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missions');
    }
};
