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
        Schema::create('skill_translations', function (Blueprint $table) {
            $table->id();
            $table->string('arabic_name');
            $table->string('english_name');
            $table->string('arabic_description')->nullable();
            $table->string('english_description')->nullable();
            $table->timestamps();
            
            $table->unique('arabic_name');
        });
        
        // إدراج البيانات الأساسية
        DB::table('skill_translations')->insert([
            [
                'arabic_name' => 'تنظيف',
                'english_name' => 'Cleaning',
                'arabic_description' => 'مهارة في تنظيف المنزل الشامل',
                'english_description' => 'Skill in comprehensive house cleaning',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'arabic_name' => 'غسيل',
                'english_name' => 'Washing',
                'arabic_description' => 'مهارة في غسيل الملابس',
                'english_description' => 'Skill in washing clothes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'arabic_name' => 'كوي',
                'english_name' => 'Ironing',
                'arabic_description' => 'مهارة في كوي الملابس',
                'english_description' => 'Skill in ironing clothes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'arabic_name' => 'طبخ',
                'english_name' => 'Cooking',
                'arabic_description' => 'مهارة في طبخ الأطباق المختلفة',
                'english_description' => 'Skill in cooking various dishes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'arabic_name' => 'رعاية اطفال',
                'english_name' => 'Child Care',
                'arabic_description' => 'مهارة في رعاية وتربية الأطفال',
                'english_description' => 'Childcare and child rearing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'arabic_name' => 'رعاية كبار السن',
                'english_name' => 'Elderly Care',
                'arabic_description' => 'مهارة في رعاية كبار السن',
                'english_description' => 'Experience in elderly care',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'arabic_name' => 'سائقة',
                'english_name' => 'Driver',
                'arabic_description' => 'مهارة في القيادة الآمنة',
                'english_description' => 'Skill in safe driving',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_translations');
    }
};