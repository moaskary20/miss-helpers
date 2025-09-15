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
        Schema::create('work_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maid_id')->constrained()->onDelete('cascade');
            $table->string('company_name'); // اسم الشركة أو المكان
            $table->string('position'); // المنصب
            $table->date('start_date'); // تاريخ البداية
            $table->date('end_date')->nullable(); // تاريخ النهاية
            $table->text('description')->nullable(); // وصف العمل
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_experiences');
    }
};
