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
        // حذف جميع خبرات العمل الموجودة وإعادة إنشائها ببيانات متنوعة
        DB::table('work_experiences')->truncate();

        // الحصول على جميع الخادمات
        $maids = DB::table('maids')->get();
        
        // أنواع الوظائف المتنوعة
        $positions = [
            'خادمة منزلية',
            'جليسة أطفال', 
            'طباخة',
            'مربية',
            'مساعدة منزلية',
            'مدبرة منزل'
        ];
        
        // البلدان
        $countries = [
            'الإمارات العربية المتحدة',
            'الكويت',
            'قطر',
            'المملكة العربية السعودية',
            'السعودية',
            'البحرين',
            'سلطنة عمان'
        ];
        
        // المدد
        $durations = [
            'سنة واحدة',
            'سنتان', 
            '3 سنوات',
            '4 سنوات',
            '5 سنوات',
            '6 سنوات',
            '7 سنوات',
            '8 سنوات'
        ];
        
        // إنشاء خبرات عمل متنوعة لكل خادمة
        foreach ($maids as $maid) {
            $numExperiences = rand(1, 3); // 1-3 خبرات لكل خادمة
            
            for ($i = 0; $i < $numExperiences; $i++) {
                $position = $positions[array_rand($positions)];
                $country = $countries[array_rand($countries)];
                $duration = $durations[array_rand($durations)];
                
                // إنشاء وصف للخبرة
                $description = $this->generateExperienceDescription($position, $country, $duration);
                
                DB::table('work_experiences')->insert([
                    'maid_id' => $maid->id,
                    'position' => $position,
                    'company_name' => $this->generateCompanyName($country),
                    'country' => $country,
                    'work_type' => 'دوام كامل',
                    'duration' => $duration,
                    'description' => $description,
                    'start_date' => now()->subYears(rand(1, 8))->format('Y-m-d'),
                    'end_date' => now()->subMonths(rand(1, 11))->format('Y-m-d'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Generate experience description based on position and country
     */
    private function generateExperienceDescription($position, $country, $duration)
    {
        $descriptions = [
            'خادمة منزلية' => "عملت كخادمة منزلية في {$country} لمدة {$duration}، حيث قمت بأعمال التنظيف والطبخ ورعاية الأطفال.",
            'جليسة أطفال' => "عملت كجليسة أطفال في {$country} لمدة {$duration}، حيث اهتممت بالأطفال وقدمت لهم الرعاية الكاملة.",
            'طباخة' => "عملت كطباخة في {$country} لمدة {$duration}، حيث تخصصت في الطبخ العربي والآسيوي.",
            'مربية' => "عملت كمربية في {$country} لمدة {$duration}، حيث اهتممت بالأطفال وساعدتهم في دروسهم.",
            'مساعدة منزلية' => "عملت كمساعدة منزلية في {$country} لمدة {$duration}، حيث ساعدت في جميع الأعمال المنزلية.",
            'مدبرة منزل' => "عملت كمدبرة منزل في {$country} لمدة {$duration}، حيث أشرفت على جميع شؤون المنزل."
        ];
        
        return $descriptions[$position] ?? $descriptions['خادمة منزلية'];
    }

    /**
     * Generate company/family name based on country
     */
    private function generateCompanyName($country)
    {
        $names = [
            'الإمارات العربية المتحدة' => 'عائلة الإمارات',
            'الكويت' => 'عائلة الكويت',
            'قطر' => 'عائلة قطر',
            'المملكة العربية السعودية' => 'عائلة السعودية',
            'السعودية' => 'عائلة السعودية',
            'البحرين' => 'عائلة البحرين',
            'سلطنة عمان' => 'عائلة عمان'
        ];
        
        return $names[$country] ?? 'عائلة محلية';
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // إرجاع البيانات الأصلية (إذا لزم الأمر)
        DB::table('work_experiences')->truncate();
    }
};