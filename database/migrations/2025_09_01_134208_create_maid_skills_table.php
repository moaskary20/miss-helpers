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
        Schema::create('maid_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maid_id')->constrained()->onDelete('cascade');
            $table->string('skill_name'); // اسم المهارة
            $table->text('description')->nullable(); // وصف المهارة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maid_skills');
    }
};
