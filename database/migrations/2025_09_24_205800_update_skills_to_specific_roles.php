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
        // حذف جميع المهارات الموجودة وإعادة إنشائها بالمهارات المطلوبة
        DB::table('maid_skills')->truncate();

        // الحصول على جميع الخادمات
        $maids = DB::table('maids')->get();
        
        // المهارات المطلوبة
        $skills = [
            'تنظيف',
            'غسيل', 
            'كوي',
            'طبخ',
            'رعاية اطفال',
            'رعاية كبار السن',
            'سائقة'
        ];
        
        // أوصاف المهارات
        $skillDescriptions = [
            'تنظيف' => 'مهارة في تنظيف المنزل الشامل',
            'غسيل' => 'مهارة في غسيل الملابس',
            'كوي' => 'مهارة في كوي الملابس',
            'طبخ' => 'مهارة في طبخ الأطباق المختلفة',
            'رعاية اطفال' => 'مهارة في رعاية وتربية الأطفال',
            'رعاية كبار السن' => 'مهارة في رعاية كبار السن',
            'سائقة' => 'مهارة في القيادة الآمنة'
        ];
        
        // إنشاء مهارات متنوعة لكل خادمة
        foreach ($maids as $maid) {
            $numSkills = rand(3, 5); // 3-5 مهارات لكل خادمة
            $selectedSkills = array_rand($skills, $numSkills);
            
            // التأكد من أن $selectedSkills هو array
            if (!is_array($selectedSkills)) {
                $selectedSkills = [$selectedSkills];
            }
            
            foreach ($selectedSkills as $skillIndex) {
                $skillName = $skills[$skillIndex];
                $skillDescription = $skillDescriptions[$skillName];
                
                DB::table('maid_skills')->insert([
                    'maid_id' => $maid->id,
                    'skill_name' => $skillName,
                    'description' => $skillDescription,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // إرجاع البيانات الأصلية (إذا لزم الأمر)
        DB::table('maid_skills')->truncate();
    }
};