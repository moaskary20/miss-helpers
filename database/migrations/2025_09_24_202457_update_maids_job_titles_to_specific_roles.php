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
        // تحديث أنواع الوظائف الموجودة إلى أنواع محددة
        $jobTitleUpdates = [
            'خادمة منزلية' => 'تنظيف',
            'عاملة منزلية' => 'تنظيف', 
            'مدبرة منزل' => 'تنظيف'
        ];

        foreach ($jobTitleUpdates as $oldTitle => $newTitle) {
            DB::table('maids')
                ->where('job_title', $oldTitle)
                ->update(['job_title' => $newTitle]);
        }

        // إضافة أنواع وظائف متنوعة للخادمات الموجودة
        $maids = DB::table('maids')->get();
        $jobTitles = ['تنظيف', 'غسيل', 'كوي', 'طبخ', 'رعاية اطفال', 'رعاية كبار السن', 'سائقة'];
        
        foreach ($maids as $index => $maid) {
            $randomJobTitle = $jobTitles[array_rand($jobTitles)];
            DB::table('maids')
                ->where('id', $maid->id)
                ->update(['job_title' => $randomJobTitle]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // إرجاع أنواع الوظائف إلى حالتها الأصلية
        $jobTitleUpdates = [
            'تنظيف' => 'خادمة منزلية',
            'غسيل' => 'خادمة منزلية',
            'كوي' => 'خادمة منزلية',
            'طبخ' => 'خادمة منزلية',
            'رعاية اطفال' => 'خادمة منزلية',
            'رعاية كبار السن' => 'خادمة منزلية',
            'سائقة' => 'خادمة منزلية'
        ];

        foreach ($jobTitleUpdates as $newTitle => $oldTitle) {
            DB::table('maids')
                ->where('job_title', $newTitle)
                ->update(['job_title' => $oldTitle]);
        }
    }
};