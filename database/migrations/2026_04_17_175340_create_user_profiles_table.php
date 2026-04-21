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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('personal_info')->nullable();
            $table->double('hourly_price')->nullable();
            $table->string('image')->nullable();
            $table->string('phone_number')->nullable();
            $table->enum('availability_status', ['available', 'unavailable','busy'])->default('available');
            $table->string('portfolio_link')->nullable();
            $table->date('intry_date')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
