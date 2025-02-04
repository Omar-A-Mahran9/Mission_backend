<?php

use App\Enums\ProductStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('description_ar');
            $table->string('description_en');
            $table->double('product_price');
            $table->double('minimum_bid');
            $table->double('start_price');
            $table->double('ticket_price');
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->integer('status')->comment('App\Enums\ProductStatus')->default(ProductStatus::Visible->value);
            $table->foreign('admin_id')->references('id')->on('admins')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
