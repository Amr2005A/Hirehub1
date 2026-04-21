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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('creator_by')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->enum('budget_type', ['fixed', 'hourly']);
            $table->double('hourly_price');
            $table->double('fixed_price');
            $table->date('date'); //تاريخ التسليم
            $table->enum('status', ['open', 'in_progress', 'closed'])->default('open');
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
