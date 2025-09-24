<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Maid;
use App\Models\MaidSkill;
use App\Models\WorkExperience;
use App\Models\CustomerReview;

class MaidSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $this->createMaids();
    }

    private function createMaids()
    {
        // بيانات الخادمات
        $maidsData = [
            [
                'name' => 'فاطمة أحمد محمد',
                'nationality' => 'الفلبين',
                'religion' => 'مسلمة',
                'language' => 'English & L.Arabic',
                'birth_date' => '1990-05-15',
                'age' => 34,
                'education' => 'ثانوي',
                'marital_status' => 'عزباء',
                'children_count' => 0,
                'height' => 155.5,
                'weight' => 52.0,
                'experience_years' => 8,
                'package_type' => 'الباقة التقليدية',
                'job_title' => 'خادمة منزلية',
                'contract_type' => 'عقد سنتين',
                'contract_fees' => 5000.00,
                'monthly_salary' => 1800.00,
                'status' => 'متاحة',
                'rating' => 5,
                'views_count' => 120,
                'reviews_count' => 8,
            ],
            [
                'name' => 'مريم السعد',
                'nationality' => 'ميانمار',
                'religion' => 'مسلمة',
                'language' => 'Little English',
                'birth_date' => '1988-12-03',
                'age' => 36,
                'education' => 'ابتدائي',
                'marital_status' => 'متزوجة',
                'children_count' => 2,
                'height' => 158.0,
                'weight' => 55.0,
                'experience_years' => 12,
                'package_type' => 'الباقة المرنة',
                'job_title' => 'خادمة منزلية',
                'contract_type' => 'عقد شهري',
                'contract_fees' => 3000.00,
                'monthly_salary' => 2000.00,
                'status' => 'متاحة',
                'rating' => 4,
                'views_count' => 95,
                'reviews_count' => 6,
            ],
        ];

        // إنشاء الخادمات
        foreach ($maidsData as $maidData) {
            $maid = Maid::create($maidData);
            $this->addSkills($maid->id);
            $this->addWorkExperiences($maid->id);
            $this->addReviews($maid->id);
            
            echo "تم إنشاء الخادمة: {$maid->name}" . PHP_EOL;
        }

        echo "تم إنشاء " . count($maidsData) . " خادمة بنجاح!" . PHP_EOL;
    }

    private function addSkills($maidId)
    {
        $skills = ['تنظيف المنزل الشامل', 'طبخ الأكلات العربية', 'رعاية الأطفال', 'غسل الملابس'];
        
        foreach ($skills as $skillName) {
            MaidSkill::create([
                'maid_id' => $maidId,
                'skill_name' => $skillName,
                'description' => "مهارة في {$skillName}",
            ]);
        }
    }

    private function addWorkExperiences($maidId)
    {
        $experiences = [
            [
                'company_name' => 'فندق الإمارات',
                'position' => 'خادمة منزلية',
                'country' => 'الإمارات العربية المتحدة',
                'work_type' => 'دوام كامل',
                'duration' => 'سنتان',
                'start_date' => '2022-01-01',
                'end_date' => '2023-12-31',
                'description' => 'عملت كخادمة منزلية في فندق الإمارات لمدة سنتين',
            ],
            [
                'company_name' => 'عائلة السعد',
                'position' => 'خادمة منزلية',
                'country' => 'الكويت',
                'work_type' => 'دوام كامل',
                'duration' => '3 سنوات',
                'start_date' => '2019-01-01',
                'end_date' => '2021-12-31',
                'description' => 'عملت كخادمة منزلية في منزل عائلة السعد في الكويت',
            ],
        ];

        foreach ($experiences as $experience) {
            WorkExperience::create([
                'maid_id' => $maidId,
                'company_name' => $experience['company_name'],
                'position' => $experience['position'],
                'country' => $experience['country'],
                'work_type' => $experience['work_type'],
                'duration' => $experience['duration'],
                'start_date' => $experience['start_date'],
                'end_date' => $experience['end_date'],
                'description' => $experience['description'],
            ]);
        }
    }

    private function addReviews($maidId)
    {
        $reviews = [
            [
                'customer_name' => 'أحمد محمد',
                'title' => 'خدمة ممتازة',
                'rating' => 5,
                'comment' => 'الخادمة تعمل بشكل ممتاز وتنظف المنزل بجدية',
                'description' => 'تقييم إيجابي للخدمة المقدمة',
                'status' => 'approved',
            ],
            [
                'customer_name' => 'فاطمة أحمد',
                'title' => 'عمل جيد جداً',
                'rating' => 4,
                'comment' => 'متفانية في العمل ومحترفة',
                'description' => 'تقييم إيجابي للخدمة المقدمة',
                'status' => 'approved',
            ],
        ];

        foreach ($reviews as $review) {
            CustomerReview::create([
                'maid_id' => $maidId,
                'customer_name' => $review['customer_name'],
                'title' => $review['title'],
                'rating' => $review['rating'],
                'comment' => $review['comment'],
                'description' => $review['description'],
                'status' => $review['status'],
            ]);
        }
    }
}