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
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Unique promo code
            $table->decimal('value', 10, 2); // Discount amount
            $table->date('starts_date'); // Start date of the promo code
            $table->date('expires_at'); // End date of the promo code
            $table->boolean('is_active')->default(true); // Is the promo code active?
            $table->unsignedBigInteger('promo_code_type_id');
            $table->foreign('promo_code_type_id')->references('id')->on('promo_code_types')->onDelete('cascade');
            $table->integer('usage_limit')->nullable(); // Limit on how many times the promo code can be used
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_codes');
    }
};
