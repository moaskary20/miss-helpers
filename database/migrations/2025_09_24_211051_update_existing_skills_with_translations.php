<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // تحديث المهارات الموجودة بالترجمة الإنجليزية
        $skills = DB::table('maid_skills')->get();
        
        foreach ($skills as $skill) {
            // البحث عن الترجمة
            $translation = DB::table('skill_translations')
                ->where('arabic_name', $skill->skill_name)
                ->first();
                
            if ($translation) {
                // تحديث اسم المهارة
                DB::table('maid_skills')
                    ->where('id', $skill->id)
                    ->update([
                        'english_name' => $translation->english_name,
                        'english_description' => $translation->english_description,
                        'updated_at' => now()
                    ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // إزالة الترجمات الإنجليزية
        DB::table('maid_skills')->update([
            'english_name' => null,
            'english_description' => null,
            'updated_at' => now()
        ]);
    }
};