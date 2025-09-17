<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Maid;
use App\Models\MaidSkill;
use App\Models\WorkExperience;
use Carbon\Carbon;

class NewMaidsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $maids = [
            [
                'name' => 'فاطمة أحمد',
                'nationality' => 'مصرية',
                'age' => 28,
                'marital_status' => 'عزباء',
                'children_count' => 0,
                'religion' => 'مسلمة',
                'language' => 'العربية',
                'education' => 'ثانوية عامة',
                'height' => 165.5,
                'weight' => 58.2,
                'package_type' => 'باقة شاملة',
                'job_title' => 'خادمة منزلية',
                'contract_type' => 'عقد سنوي',
                'contract_fees' => 5000.00,
                'monthly_salary' => 1200.00,
                'service_type' => 'خدمات منزلية',
                'experience_years' => 5,
                'status' => 'متاحة',
                'rating' => 4.5,
                'views_count' => 0,
                'reviews_count' => 0,
                'work_type' => 'دوام كامل',
                'languages' => 'العربية، الإنجليزية',
                'previous_experience' => 'خبرة 5 سنوات في التنظيف والطبخ ورعاية الأطفال',
                'image_path' => 'maids/images/maid1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'مريم السعيد',
                'nationality' => 'سورية',
                'age' => 32,
                'marital_status' => 'متزوجة',
                'children_count' => 2,
                'religion' => 'مسلمة',
                'language' => 'العربية',
                'education' => 'جامعية',
                'height' => 160.0,
                'weight' => 62.0,
                'package_type' => 'باقة مميزة',
                'job_title' => 'مدبرة منزل',
                'contract_type' => 'عقد سنوي',
                'contract_fees' => 6000.00,
                'monthly_salary' => 1500.00,
                'service_type' => 'إدارة منزلية',
                'experience_years' => 8,
                'status' => 'متاحة',
                'rating' => 4.8,
                'views_count' => 0,
                'reviews_count' => 0,
                'work_type' => 'دوام كامل',
                'languages' => 'العربية، التركية',
                'previous_experience' => 'خبرة 8 سنوات في إدارة المنزل والطبخ المتقدم',
                'image_path' => 'maids/images/maid2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'أميرة محمد',
                'nationality' => 'مغربية',
                'age' => 25,
                'marital_status' => 'عزباء',
                'children_count' => 0,
                'religion' => 'مسلمة',
                'language' => 'العربية',
                'education' => 'ثانوية عامة',
                'height' => 168.0,
                'weight' => 55.0,
                'package_type' => 'باقة أساسية',
                'job_title' => 'خادمة منزلية',
                'contract_type' => 'عقد سنوي',
                'contract_fees' => 4000.00,
                'monthly_salary' => 1000.00,
                'service_type' => 'خدمات منزلية',
                'experience_years' => 3,
                'status' => 'متاحة',
                'rating' => 4.2,
                'views_count' => 0,
                'reviews_count' => 0,
                'work_type' => 'دوام كامل',
                'languages' => 'العربية، الفرنسية',
                'previous_experience' => 'خبرة 3 سنوات في التنظيف والطبخ البسيط',
                'image_path' => 'maids/images/maid3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'زينب علي',
                'nationality' => 'لبنانية',
                'age' => 35,
                'marital_status' => 'مطلقة',
                'children_count' => 1,
                'religion' => 'مسلمة',
                'language' => 'العربية',
                'education' => 'جامعية',
                'height' => 162.0,
                'weight' => 65.0,
                'package_type' => 'باقة شاملة',
                'job_title' => 'مدبرة منزل',
                'contract_type' => 'عقد سنوي',
                'contract_fees' => 7000.00,
                'monthly_salary' => 1800.00,
                'service_type' => 'إدارة منزلية',
                'experience_years' => 10,
                'status' => 'متاحة',
                'rating' => 4.9,
                'views_count' => 0,
                'reviews_count' => 0,
                'work_type' => 'دوام كامل',
                'languages' => 'العربية، الإنجليزية، الفرنسية',
                'previous_experience' => 'خبرة 10 سنوات في إدارة المنزل والطبخ المتقدم ورعاية المسنين',
                'image_path' => 'maids/images/maid4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'نور الدين',
                'nationality' => 'تونسية',
                'age' => 29,
                'marital_status' => 'عزباء',
                'children_count' => 0,
                'religion' => 'مسلمة',
                'language' => 'العربية',
                'education' => 'ثانوية عامة',
                'height' => 170.0,
                'weight' => 60.0,
                'package_type' => 'باقة مميزة',
                'job_title' => 'خادمة منزلية',
                'contract_type' => 'عقد سنوي',
                'contract_fees' => 5500.00,
                'monthly_salary' => 1300.00,
                'service_type' => 'خدمات منزلية',
                'experience_years' => 6,
                'status' => 'متاحة',
                'rating' => 4.6,
                'views_count' => 0,
                'reviews_count' => 0,
                'work_type' => 'دوام كامل',
                'languages' => 'العربية، الفرنسية',
                'previous_experience' => 'خبرة 6 سنوات في التنظيف والطبخ ورعاية الأطفال',
                'image_path' => 'maids/images/maid5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'سارة حسن',
                'nationality' => 'أردنية',
                'age' => 31,
                'marital_status' => 'متزوجة',
                'children_count' => 3,
                'religion' => 'مسلمة',
                'language' => 'العربية',
                'education' => 'جامعية',
                'height' => 158.0,
                'weight' => 63.0,
                'package_type' => 'باقة شاملة',
                'job_title' => 'مدبرة منزل',
                'contract_type' => 'عقد سنوي',
                'contract_fees' => 6500.00,
                'monthly_salary' => 1600.00,
                'service_type' => 'إدارة منزلية',
                'experience_years' => 7,
                'status' => 'متاحة',
                'rating' => 4.7,
                'views_count' => 0,
                'reviews_count' => 0,
                'work_type' => 'دوام كامل',
                'languages' => 'العربية، الإنجليزية',
                'previous_experience' => 'خبرة 7 سنوات في إدارة المنزل والطبخ المتقدم ورعاية الأطفال',
                'image_path' => 'maids/images/maid6.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($maids as $maidData) {
            $maid = Maid::create($maidData);

            // إضافة المهارات
            $skills = [
                ['skill_name' => 'التنظيف', 'description' => 'تنظيف شامل للمنزل'],
                ['skill_name' => 'الطبخ', 'description' => 'طبخ الأطباق العربية والأجنبية'],
                ['skill_name' => 'رعاية الأطفال', 'description' => 'رعاية وتربية الأطفال'],
                ['skill_name' => 'الغسيل والكي', 'description' => 'غسيل وكي الملابس'],
                ['skill_name' => 'التسوق', 'description' => 'تسوق احتياجات المنزل'],
            ];

            foreach ($skills as $skillData) {
                MaidSkill::create([
                    'maid_id' => $maid->id,
                    'skill_name' => $skillData['skill_name'],
                    'description' => $skillData['description'],
                ]);
            }

            // إضافة الخبرات العملية
            $workExperiences = [
                [
                    'company_name' => 'عائلة ' . $maid->name,
                    'position' => 'خادمة منزلية',
                    'country' => 'السعودية',
                    'work_type' => 'دوام كامل',
                    'duration' => $maid->experience_years . ' سنوات',
                    'start_date' => Carbon::now()->subYears($maid->experience_years),
                    'end_date' => null,
                    'description' => 'عملت كخادمة منزلية في عدة منازل مع خبرة في جميع الأعمال المنزلية',
                ],
            ];

            foreach ($workExperiences as $expData) {
                WorkExperience::create([
                    'maid_id' => $maid->id,
                    'company_name' => $expData['company_name'],
                    'position' => $expData['position'],
                    'country' => $expData['country'],
                    'work_type' => $expData['work_type'],
                    'duration' => $expData['duration'],
                    'start_date' => $expData['start_date'],
                    'end_date' => $expData['end_date'],
                    'description' => $expData['description'],
                ]);
            }
        }

        $this->command->info('تم إنشاء 6 خادمات جديدة بنجاح!');
    }
}