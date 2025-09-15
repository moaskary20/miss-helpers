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
        Schema::table('work_experiences', function (Blueprint $table) {
            $table->string('country')->nullable()->after('position'); // البلد
            $table->string('work_type')->nullable()->after('country'); // نوع العمل
            $table->string('duration')->nullable()->after('work_type'); // المدة
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('work_experiences', function (Blueprint $table) {
            $table->dropColumn(['country', 'work_type', 'duration']);
        });
    }
};
