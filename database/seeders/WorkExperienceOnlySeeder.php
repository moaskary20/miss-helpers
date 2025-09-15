<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Maid;
use App\Models\WorkExperience;
use Carbon\Carbon;

class WorkExperienceOnlySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "بدء إضافة خبرات العمل للخادمات الموجودة...\n\n";

        // قائمة خبرات العمل الوهمية
        $workExperiences = [
            [
                'company_name' => 'عائلة السعيد',
                'position' => 'خادمة منزلية',
                'country' => 'الإمارات العربية المتحدة',
                'work_type' => 'عقد سنتين',
                'duration' => '2 سنة',
                'start_date' => '2022-01-01',
                'end_date' => '2024-01-01',
                'description' => 'عملت كخادمة منزلية في عائلة مكونة من 4 أفراد، مسؤولة عن التنظيف والطبخ ورعاية الأطفال.',
            ],
            [
                'company_name' => 'عائلة المحمود',
                'position' => 'مربية أطفال',
                'country' => 'الإمارات العربية المتحدة',
                'work_type' => 'عقد سنتين',
                'duration' => '3 سنوات',
                'start_date' => '2019-03-15',
                'end_date' => '2022-03-15',
                'description' => 'متخصصة في رعاية الأطفال من سن 2-8 سنوات، مساعدة في الواجبات المدرسية والأنشطة الترفيهية.',
            ],
            [
                'company_name' => 'عائلة الرشيد',
                'position' => 'طباخة',
                'country' => 'الإمارات العربية المتحدة',
                'work_type' => 'عقد سنتين',
                'duration' => '2.5 سنة',
                'start_date' => '2021-06-01',
                'end_date' => '2024-01-01',
                'description' => 'متخصصة في الطبخ العربي والهندي، إعداد وجبات صحية ومتنوعة للعائلة.',
            ],
            [
                'company_name' => 'عائلة الكندي',
                'position' => 'خادمة منزلية',
                'country' => 'الإمارات العربية المتحدة',
                'work_type' => 'عقد سنتين',
                'duration' => '4 سنوات',
                'start_date' => '2018-09-01',
                'end_date' => '2022-09-01',
                'description' => 'خبرة طويلة في إدارة المنزل، تنظيف شامل، غسيل وكي الملابس، ترتيب المنزل.',
            ],
            [
                'company_name' => 'عائلة الزهراني',
                'position' => 'مقدمة رعاية للمسنين',
                'country' => 'الإمارات العربية المتحدة',
                'work_type' => 'عقد سنتين',
                'duration' => '2 سنة',
                'start_date' => '2020-11-01',
                'end_date' => '2022-11-01',
                'description' => 'متخصصة في رعاية كبار السن، مساعدة في الأدوية والتمارين والأنشطة اليومية.',
            ],
            [
                'company_name' => 'عائلة القحطاني',
                'position' => 'خادمة منزلية',
                'country' => 'الإمارات العربية المتحدة',
                'work_type' => 'عقد سنتين',
                'duration' => '3 سنوات',
                'start_date' => '2019-04-15',
                'end_date' => '2022-04-15',
                'description' => 'عملت في منزل كبير مكون من طابقين، مسؤولة عن التنظيف اليومي وإعداد الوجبات.',
            ],
            [
                'company_name' => 'عائلة الشمري',
                'position' => 'جليسة أطفال',
                'country' => 'الإمارات العربية المتحدة',
                'work_type' => 'عقد سنتين',
                'duration' => '1.5 سنة',
                'start_date' => '2022-07-01',
                'end_date' => '2024-01-01',
                'description' => 'متخصصة في رعاية الأطفال الرضع والأطفال الصغار، خبرة في تغيير الحفاضات والرضاعة.',
            ],
            [
                'company_name' => 'عائلة المطيري',
                'position' => 'خادمة منزلية',
                'country' => 'الإمارات العربية المتحدة',
                'work_type' => 'عقد سنتين',
                'duration' => '2 سنة',
                'start_date' => '2021-01-01',
                'end_date' => '2023-01-01',
                'description' => 'عملت في عائلة صغيرة، مسؤولة عن جميع الأعمال المنزلية والطبخ البسيط.',
            ],
            [
                'company_name' => 'عائلة العتيبي',
                'position' => 'طباخة',
                'country' => 'الإمارات العربية المتحدة',
                'work_type' => 'عقد سنتين',
                'duration' => '3 سنوات',
                'start_date' => '2020-02-01',
                'end_date' => '2023-02-01',
                'description' => 'متخصصة في الطبخ العربي الأصيل، إعداد الأطباق التقليدية والوجبات الصحية.',
            ],
            [
                'company_name' => 'عائلة الغامدي',
                'position' => 'خادمة منزلية',
                'country' => 'الإمارات العربية المتحدة',
                'work_type' => 'عقد سنتين',
                'duration' => '2.5 سنة',
                'start_date' => '2021-08-01',
                'end_date' => '2024-02-01',
                'description' => 'خبرة في تنظيف المنازل الكبيرة، استخدام أدوات التنظيف الحديثة، تنظيم المنزل.',
            ],
            [
                'company_name' => 'عائلة الحربي',
                'position' => 'مربية أطفال',
                'country' => 'الإمارات العربية المتحدة',
                'work_type' => 'عقد سنتين',
                'duration' => '4 سنوات',
                'start_date' => '2018-12-01',
                'end_date' => '2022-12-01',
                'description' => 'متخصصة في رعاية الأطفال في المرحلة الابتدائية، مساعدة في الواجبات والأنشطة التعليمية.',
            ],
            [
                'company_name' => 'عائلة النعيمي',
                'position' => 'خادمة منزلية',
                'country' => 'الإمارات العربية المتحدة',
                'work_type' => 'عقد سنتين',
                'duration' => '2 سنة',
                'start_date' => '2022-03-01',
                'end_date' => '2024-03-01',
                'description' => 'عملت في شقة صغيرة، مسؤولة عن التنظيف اليومي والطبخ البسيط.',
            ],
            [
                'company_name' => 'عائلة الدوسري',
                'position' => 'مقدمة رعاية',
                'country' => 'الإمارات العربية المتحدة',
                'work_type' => 'عقد سنتين',
                'duration' => '3 سنوات',
                'start_date' => '2020-05-01',
                'end_date' => '2023-05-01',
                'description' => 'متخصصة في رعاية كبار السن والأطفال، خبرة في تقديم الدعم النفسي والجسدي.',
            ],
            [
                'company_name' => 'عائلة البلوي',
                'position' => 'خادمة منزلية',
                'country' => 'الإمارات العربية المتحدة',
                'work_type' => 'عقد سنتين',
                'duration' => '2 سنة',
                'start_date' => '2021-10-01',
                'end_date' => '2023-10-01',
                'description' => 'عملت في منزل حديث، استخدام أحدث أدوات التنظيف والتقنيات المنزلية.',
            ],
            [
                'company_name' => 'عائلة الجهني',
                'position' => 'طباخة',
                'country' => 'الإمارات العربية المتحدة',
                'work_type' => 'عقد سنتين',
                'duration' => '2.5 سنة',
                'start_date' => '2021-03-01',
                'end_date' => '2023-09-01',
                'description' => 'متخصصة في الطبخ الصحي والوجبات الغذائية المتوازنة، خبرة في الطبخ النباتي.',
            ],
        ];

        // الحصول على جميع الخادمات
        $maids = Maid::all();

        if ($maids->count() == 0) {
            echo "لا توجد خادمات في قاعدة البيانات!\n";
            return;
        }

        $addedCount = 0;
        $skippedCount = 0;

        foreach ($maids as $maid) {
            // التأكد من عدم وجود خبرات عمل مسبقاً
            if ($maid->workExperiences()->count() == 0) {
                // اختيار خبرة عمل عشوائية أو متعددة
                $numberOfExperiences = rand(1, 3); // من 1 إلى 3 خبرات
                $selectedExperiences = array_rand($workExperiences, min($numberOfExperiences, count($workExperiences)));
                
                // التأكد من أن $selectedExperiences هو array
                if (!is_array($selectedExperiences)) {
                    $selectedExperiences = [$selectedExperiences];
                }

                $totalYears = 0;

                foreach ($selectedExperiences as $index) {
                    $experience = $workExperiences[$index];
                    
                    // إنشاء خبرة عمل جديدة
                    WorkExperience::create([
                        'maid_id' => $maid->id,
                        'company_name' => $experience['company_name'],
                        'position' => $experience['position'],
                        'country' => $experience['country'],
                        'work_type' => $experience['work_type'],
                        'duration' => $experience['duration'],
                        'start_date' => Carbon::parse($experience['start_date']),
                        'end_date' => Carbon::parse($experience['end_date']),
                        'description' => $experience['description'],
                    ]);

                    // حساب سنوات الخبرة
                    $duration = $experience['duration'];
                    preg_match('/(\d+(?:\.\d+)?)/', $duration, $matches);
                    if (isset($matches[1])) {
                        $totalYears += floatval($matches[1]);
                    }
                }

                // تحديث سنوات الخبرة في جدول الخادمات
                $maid->update([
                    'experience_years' => round($totalYears, 1)
                ]);

                echo "✅ تم إضافة " . count($selectedExperiences) . " خبرة عمل للخادمة: " . $maid->name . " (سنوات الخبرة: " . round($totalYears, 1) . ")\n";
                $addedCount++;
            } else {
                echo "⏭️  الخادمة " . $maid->name . " لديها خبرات عمل بالفعل (" . $maid->workExperiences()->count() . " خبرة)\n";
                $skippedCount++;
            }
        }

        echo "\n📊 ملخص العملية:\n";
        echo "✅ تم إضافة خبرات عمل لـ " . $addedCount . " خادمة\n";
        echo "⏭️  تم تخطي " . $skippedCount . " خادمة (لديها خبرات بالفعل)\n";
        echo "🎉 تم الانتهاء من إضافة خبرات العمل للخادمات!\n\n";
    }
}
