<?php

use App\Enums\Provider;
use App\Enums\UserStatus;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->longText('short_description');
            $table->longText('description');
            $table->longText('bio')->nullable();
            $table->string('image')->nullable();
            $table->string('cover')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->boolean('is_valid')->default(false);
            $table->longText('fcm_token')->nullable();
            $table->integer('status')->comment('App\Enums\User')->default(UserStatus::Active->value);
            $table->string('password');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('field_id');
            $table->foreign('city_id')->references('id')->on('cities')->cascadeOnDelete();
            $table->foreign('field_id')->references('id')->on(' ')->cascadeOnDelete();
            $table->timestamp('verified_at')->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
