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
        Schema::create('maids', function (Blueprint $table) {
            $table->id();
            
            // المعلومات الشخصية
            $table->string('name'); // اسم الخادمة
            $table->string('video_path')->nullable(); // فيديو الخادمة
            $table->string('image_path')->nullable(); // صورة الخادمة
            $table->string('religion'); // الديانة
            $table->string('language'); // اللغة
            $table->date('birth_date'); // تاريخ الميلاد
            $table->integer('age'); // العمر
            $table->string('education'); // التعليم
            $table->decimal('height', 5, 2)->nullable(); // الطول
            $table->decimal('weight', 5, 2)->nullable(); // الوزن
            
            // معلومات العقد
            $table->string('package_type'); // نوع الباقة
            $table->string('job_title'); // الوظيفة
            $table->string('contract_type'); // نوع العقد
            $table->decimal('contract_fees', 10, 2); // رسوم العقد
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maids');
    }
};
