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
        // التأكد من وجود جميع أنواع الخدمات المطلوبة في قاعدة البيانات
        $requiredServiceTypes = [
            'تنظيف',
            'غسيل', 
            'كوي',
            'طبخ',
            'رعاية اطفال',
            'رعاية كبار السن',
            'سائقة'
        ];
        
        // الحصول على الخادمات الموجودة
        $existingMaids = DB::table('maids')->get();
        
        // إذا لم تكن هناك خادمات، أنشئ خادمة تجريبية لكل نوع خدمة
        if ($existingMaids->count() == 0) {
            foreach ($requiredServiceTypes as $serviceType) {
                DB::table('maids')->insert([
                    'name' => 'خادمة تجريبية - ' . $serviceType,
                    'nationality' => 'الفلبين',
                    'religion' => 'مسلمة',
                    'language' => 'عربية',
                    'birth_date' => '1990-01-01',
                    'age' => 30,
                    'education' => 'ثانوية',
                    'marital_status' => 'عزباء',
                    'children_count' => 0,
                    'experience_years' => 5,
                    'job_title' => $serviceType,
                    'status' => 'متاحة',
                    'package_type' => 'الباقة المرنة',
                    'contract_fees' => 1000,
                    'monthly_salary' => 500,
                    'views_count' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } else {
            // إذا كانت هناك خادمات موجودة، تأكد من وجود جميع أنواع الخدمات
            $existingServiceTypes = DB::table('maids')->distinct()->pluck('job_title')->toArray();
            
            foreach ($requiredServiceTypes as $serviceType) {
                if (!in_array($serviceType, $existingServiceTypes)) {
                    // أنشئ خادمة تجريبية لهذا النوع من الخدمة
                    DB::table('maids')->insert([
                        'name' => 'خادمة تجريبية - ' . $serviceType,
                        'nationality' => 'الفلبين',
                        'religion' => 'مسلمة',
                        'language' => 'عربية',
                        'birth_date' => '1990-01-01',
                        'age' => 30,
                        'education' => 'ثانوية',
                        'marital_status' => 'عزباء',
                        'children_count' => 0,
                        'experience_years' => 5,
                        'job_title' => $serviceType,
                        'status' => 'متاحة',
                        'package_type' => 'الباقة المرنة',
                        'contract_fees' => 1000,
                        'monthly_salary' => 500,
                        'views_count' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // حذف الخادمات التجريبية التي تم إنشاؤها
        DB::table('maids')->where('name', 'LIKE', 'خادمة تجريبية - %')->delete();
    }
};