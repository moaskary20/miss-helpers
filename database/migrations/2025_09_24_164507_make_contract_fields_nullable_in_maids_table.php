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
        Schema::table('maids', function (Blueprint $table) {
            // جعل حقلي رسوم العقد والراتب الشهري nullable
            $table->decimal('contract_fees', 10, 2)->nullable()->change();
            $table->decimal('monthly_salary', 10, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('maids', function (Blueprint $table) {
            // إعادة الحقول إلى حالتها الأصلية
            $table->decimal('contract_fees', 10, 2)->nullable(false)->default(0)->change();
            $table->decimal('monthly_salary', 10, 2)->nullable(false)->default(0)->change();
        });
    }
};