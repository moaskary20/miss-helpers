<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Maid;
use App\Models\WorkExperience;
use Carbon\Carbon;

class AddWorkExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
        ];

        // الحصول على جميع الخادمات
        $maids = Maid::all();

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
                }

                // تحديث سنوات الخبرة الإجمالية للخادمة
                $totalYears = 0;
                foreach ($selectedExperiences as $index) {
                    $duration = $workExperiences[$index]['duration'];
                    // استخراج الأرقام من النص (مثل "2 سنة" أو "3 سنوات" أو "2.5 سنة")
                    preg_match('/(\d+(?:\.\d+)?)/', $duration, $matches);
                    if (isset($matches[1])) {
                        $totalYears += floatval($matches[1]);
                    }
                }

                // تحديث سنوات الخبرة في جدول الخادمات
                $maid->update([
                    'experience_years' => round($totalYears, 1)
                ]);

                echo "تم إضافة " . count($selectedExperiences) . " خبرة عمل للخادمة: " . $maid->name . " (سنوات الخبرة: " . round($totalYears, 1) . ")\n";
            } else {
                echo "الخادمة " . $maid->name . " لديها خبرات عمل بالفعل\n";
            }
        }

        echo "\nتم الانتهاء من إضافة خبرات العمل للخادمات!\n";
    }
}
