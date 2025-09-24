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
        Schema::table('maid_skills', function (Blueprint $table) {
            $table->string('english_name')->nullable()->after('skill_name');
            $table->string('english_description')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('maid_skills', function (Blueprint $table) {
            $table->dropColumn(['english_name', 'english_description']);
        });
    }
};