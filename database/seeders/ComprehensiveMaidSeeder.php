<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Maid;
use App\Models\MaidSkill;
use App\Models\WorkExperience;
use App\Models\CustomerReview;

class ComprehensiveMaidSeeder extends Seeder
{
    public function run(): void
    {
        $this->createMoreMaids();
    }

    private function createMoreMaids()
    {
        $maidsData = [
            [
                'name' => 'سارة محمود',
                'nationality' => 'اثيوبيا',
                'religion' => 'مسيحية',
                'language' => 'Arabic & L.English',
                'birth_date' => '1992-08-20',
                'age' => 32,
                'education' => 'جامعي',
                'marital_status' => 'عزباء',
                'children_count' => 0,
                'height' => 162.0,
                'weight' => 58.0,
                'experience_years' => 6,
                'package_type' => 'باقة أساسية',
                'job_title' => 'خادمة منزلية',
                'contract_type' => 'عقد سنتين',
                'contract_fees' => 4000.00,
                'monthly_salary' => 1600.00,
                'status' => 'متاحة',
                'rating' => 5,
                'views_count' => 78,
                'reviews_count' => 4,
            ],
            [
                'name' => 'نور الدين',
                'nationality' => 'سريلانكا',
                'religion' => 'مسلمة',
                'language' => 'English',
                'birth_date' => '1985-03-10',
                'age' => 39,
                'education' => 'ثانوي',
                'marital_status' => 'متزوجة',
                'children_count' => 3,
                'height' => 160.0,
                'weight' => 60.0,
                'experience_years' => 15,
                'package_type' => 'الباقة التقليدية',
                'job_title' => 'خادمة منزلية',
                'contract_type' => 'عقد سنتين',
                'contract_fees' => 6000.00,
                'monthly_salary' => 2200.00,
                'status' => 'متاحة',
                'rating' => 4,
                'views_count' => 150,
                'reviews_count' => 12,
            ],
            [
                'name' => 'خديجة عمر',
                'nationality' => 'اوغندا',
                'religion' => 'مسلمة',
                'language' => 'Little Arabic',
                'birth_date' => '1995-11-25',
                'age' => 29,
                'education' => 'متوسط',
                'marital_status' => 'عزباء',
                'children_count' => 0,
                'height' => 157.0,
                'weight' => 53.0,
                'experience_years' => 4,
                'package_type' => 'الباقة المرنة',
                'job_title' => 'خادمة منزلية',
                'contract_type' => 'عقد شهري',
                'contract_fees' => 2500.00,
                'monthly_salary' => 1400.00,
                'status' => 'متاحة',
                'rating' => 3,
                'views_count' => 45,
                'reviews_count' => 2,
            ],
            [
                'name' => 'أمينة حسن',
                'nationality' => 'كينيا',
                'religion' => 'مسلمة',
                'language' => 'English & L.Arabic',
                'birth_date' => '1991-07-08',
                'age' => 33,
                'education' => 'ثانوي',
                'marital_status' => 'متزوجة',
                'children_count' => 1,
                'height' => 159.0,
                'weight' => 56.0,
                'experience_years' => 7,
                'package_type' => 'باقة أساسية',
                'job_title' => 'خادمة منزلية',
                'contract_type' => 'عقد سنتين',
                'contract_fees' => 4500.00,
                'monthly_salary' => 1700.00,
                'status' => 'متاحة',
                'rating' => 4,
                'views_count' => 88,
                'reviews_count' => 5,
            ],
            [
                'name' => 'زينب محمد',
                'nationality' => 'مدغشقر',
                'religion' => 'مسلمة',
                'language' => 'Little English',
                'birth_date' => '1987-09-14',
                'age' => 37,
                'education' => 'ابتدائي',
                'marital_status' => 'متزوجة',
                'children_count' => 2,
                'height' => 156.0,
                'weight' => 54.0,
                'experience_years' => 10,
                'package_type' => 'الباقة التقليدية',
                'job_title' => 'خادمة منزلية',
                'contract_type' => 'عقد سنتين',
                'contract_fees' => 5500.00,
                'monthly_salary' => 1900.00,
                'status' => 'متاحة',
                'rating' => 5,
                'views_count' => 110,
                'reviews_count' => 7,
            ],
            [
                'name' => 'عائشة أحمد',
                'nationality' => 'اندونيسيا',
                'religion' => 'مسلمة',
                'language' => 'Arabic',
                'birth_date' => '1993-04-22',
                'age' => 31,
                'education' => 'ثانوي',
                'marital_status' => 'عزباء',
                'children_count' => 0,
                'height' => 161.0,
                'weight' => 57.0,
                'experience_years' => 5,
                'package_type' => 'الباقة المرنة',
                'job_title' => 'خادمة منزلية',
                'contract_type' => 'عقد شهري',
                'contract_fees' => 3200.00,
                'monthly_salary' => 1500.00,
                'status' => 'متاحة',
                'rating' => 4,
                'views_count' => 67,
                'reviews_count' => 3,
            ],
        ];

        foreach ($maidsData as $maidData) {
            $maid = Maid::create($maidData);
            $this->addSkills($maid->id);
            $this->addWorkExperiences($maid->id);
            $this->addReviews($maid->id);
            
            echo "تم إنشاء الخادمة: {$maid->name}" . PHP_EOL;
        }

        echo "تم إنشاء " . count($maidsData) . " خادمة إضافية بنجاح!" . PHP_EOL;
    }

    private function addSkills($maidId)
    {
        $allSkills = [
            'تنظيف المنزل الشامل',
            'طبخ الأكلات العربية',
            'طبخ الأكلات الآسيوية',
            'رعاية الأطفال',
            'غسل الملابس',
            'كوي الملابس',
            'تنظيف السجاد',
            'تنظيف الزجاج',
            'تنظيم المنزل',
            'الحديقة والبستنة',
            'رعاية المسنين',
            'إدارة المنزل',
        ];
        
        $randomSkills = collect($allSkills)->random(rand(3, 6));
        
        foreach ($randomSkills as $skillName) {
            MaidSkill::create([
                'maid_id' => $maidId,
                'skill_name' => $skillName,
                'description' => "مهارة في {$skillName}",
            ]);
        }
    }

    private function addWorkExperiences($maidId)
    {
        $allExperiences = [
            [
                'company_name' => 'فندق الإمارات',
                'position' => 'خادمة منزلية',
                'country' => 'الإمارات العربية المتحدة',
                'work_type' => 'دوام كامل',
                'duration' => 'سنتان',
                'start_date' => '2022-01-01',
                'end_date' => '2023-12-31',
                'description' => 'عملت كخادمة منزلية في فندق الإمارات لمدة سنتين، حيث قمت بتنظيف الغرف وتقديم الخدمات للنزلاء.',
            ],
            [
                'company_name' => 'عائلة السعد',
                'position' => 'خادمة منزلية',
                'country' => 'الكويت',
                'work_type' => 'دوام كامل',
                'duration' => '3 سنوات',
                'start_date' => '2019-01-01',
                'end_date' => '2021-12-31',
                'description' => 'عملت كخادمة منزلية في منزل عائلة السعد في الكويت لمدة 3 سنوات، حيث قمت بأعمال التنظيف والطبخ ورعاية الأطفال.',
            ],
            [
                'company_name' => 'فندق الدانة',
                'position' => 'خادمة منزلية',
                'country' => 'الإمارات العربية المتحدة',
                'work_type' => 'دوام جزئي',
                'duration' => 'سنة واحدة',
                'start_date' => '2021-06-01',
                'end_date' => '2022-05-31',
                'description' => 'عملت كخادمة منزلية في فندق الدانة بدوام جزئي لمدة سنة، حيث تخصصت في تنظيف الغرف الفاخرة.',
            ],
            [
                'company_name' => 'عائلة المطيري',
                'position' => 'خادمة منزلية',
                'country' => 'السعودية',
                'work_type' => 'دوام كامل',
                'duration' => 'سنتان',
                'start_date' => '2020-01-01',
                'end_date' => '2021-12-31',
                'description' => 'عملت كخادمة منزلية في منزل عائلة المطيري في الرياض لمدة سنتين، حيث قمت برعاية الأطفال الصغار والتنظيف اليومي.',
            ],
            [
                'company_name' => 'فندق قطر',
                'position' => 'خادمة منزلية',
                'country' => 'قطر',
                'work_type' => 'دوام كامل',
                'duration' => 'سنة واحدة',
                'start_date' => '2021-01-01',
                'end_date' => '2021-12-31',
                'description' => 'عملت كخادمة منزلية في فندق قطر لمدة سنة، حيث تخصصت في تنظيف الشقق الفندقية.',
            ],
        ];

        $randomExperiences = collect($allExperiences)->random(rand(1, 3));
        
        foreach ($randomExperiences as $experience) {
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
        $allReviews = [
            [
                'customer_name' => 'أحمد محمد',
                'title' => 'خدمة ممتازة',
                'rating' => 5,
                'comment' => 'الخادمة تعمل بشكل ممتاز وتنظف المنزل بجدية. أنصح بها بشدة',
                'description' => 'تقييم إيجابي للخدمة المقدمة',
                'status' => 'approved',
            ],
            [
                'customer_name' => 'فاطمة أحمد',
                'title' => 'عمل جيد جداً',
                'rating' => 4,
                'comment' => 'متفانية في العمل ومحترفة. سعيد بالخدمة',
                'description' => 'تقييم إيجابي للخدمة المقدمة',
                'status' => 'approved',
            ],
            [
                'customer_name' => 'خالد السعد',
                'title' => 'أداء رائع',
                'rating' => 5,
                'comment' => 'خادمة محترفة ومتفانية. تنظف بجودة عالية وتهتم بالتفاصيل',
                'description' => 'تقييم إيجابي للخدمة المقدمة',
                'status' => 'approved',
            ],
            [
                'customer_name' => 'مريم حسن',
                'title' => 'خدمة مرضية',
                'rating' => 4,
                'comment' => 'عمل جيد ومنظم. أنصح بالتعامل معها',
                'description' => 'تقييم إيجابي للخدمة المقدمة',
                'status' => 'approved',
            ],
            [
                'customer_name' => 'عبدالله محمد',
                'title' => 'ممتازة',
                'rating' => 5,
                'comment' => 'خادمة مجتهدة ونظيفة. خدمة ممتازة ومهنية عالية',
                'description' => 'تقييم إيجابي للخدمة المقدمة',
                'status' => 'approved',
            ],
            [
                'customer_name' => 'نورا أحمد',
                'title' => 'عمل ممتاز',
                'rating' => 5,
                'comment' => 'خادمة محترفة ومتفانية في العمل. أنصح بها بشدة',
                'description' => 'تقييم إيجابي للخدمة المقدمة',
                'status' => 'approved',
            ],
        ];

        $randomReviews = collect($allReviews)->random(rand(2, 4));
        
        foreach ($randomReviews as $review) {
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
