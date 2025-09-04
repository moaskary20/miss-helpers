<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Maid;
use App\Models\Category;
use App\Models\Post;
use App\Models\CustomerReview;
use App\Models\ServiceRequest;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use App\Models\MaidSkill;
use App\Models\WorkExperience;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CompleteDataWithImagesSeeder extends Seeder
{
    public function run(): void
    {
        $this->createUsers();
        $this->createCategories();
        $this->createMaidsWithImages();
        $this->createPostsWithImages();
        $this->createCustomerReviews();
        $this->createServiceRequests();
        $this->createChatData();
        
        $this->command->info('تم إنشاء جميع البيانات مع الصور بنجاح!');
    }
    
    private function createUsers()
    {
        User::create([
            'name' => 'محمد العسكري',
            'username' => 'admin',
            'email' => 'mo.askary@gmail.com',
            'password' => Hash::make('newpassword'),
            'phone' => '+971501234567',
            'role' => 'super_admin',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
    }
    
    private function createCategories()
    {
        $categories = [
            ['name' => 'خادمات منزلية', 'slug' => 'domestic-maids', 'is_active' => true],
            ['name' => 'خادمات للطبخ', 'slug' => 'cooking-maids', 'is_active' => true],
            ['name' => 'خادمات للتنظيف', 'slug' => 'cleaning-maids', 'is_active' => true],
            ['name' => 'خادمات للعناية بالأطفال', 'slug' => 'childcare-maids', 'is_active' => true],
        ];
        
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
    
    private function createMaidsWithImages()
    {
        $maidsData = [
            [
                'name' => 'سارة أحمد',
                'religion' => 'مسلمة',
                'language' => 'عربية',
                'birth_date' => '1995-03-15',
                'age' => 29,
                'education' => 'ثانوي',
                'height' => 165.5,
                'weight' => 60.0,
                'package_type' => 'باقة متقدمة',
                'job_title' => 'خادمة منزلية',
                'contract_type' => 'عقد سنوي',
                'contract_fees' => 15000,
                'nationality' => 'مصرية',
                'service_type' => 'خادمة منزلية',
                'experience_years' => 5,
                'status' => 'متاحة',
                'rating' => 4.8,
                'views_count' => 150,
                'reviews_count' => 12,
                'marital_status' => 'متزوجة',
                'children_count' => 2,
                'work_type' => 'دوام كامل',
                'languages' => 'العربية، الإنجليزية',
                'skills' => 'تنظيف المنزل، الطبخ، العناية بالأطفال',
                'previous_experience' => 'خبرة 5 سنوات في التنظيف والطبخ ورعاية الأطفال',
                'photo' => 'maids/images/SGZ8T2FkpanC3YaQWx6N3jmJ3YoQzErG3e5EBC47.jpg',
                'image_path' => 'maids/images/SGZ8T2FkpanC3YaQWx6N3jmJ3YoQzErG3e5EBC47.jpg',
            ],
            [
                'name' => 'فاطمة محمد',
                'religion' => 'مسلمة',
                'language' => 'عربية',
                'birth_date' => '1990-07-22',
                'age' => 34,
                'education' => 'جامعي',
                'height' => 160.0,
                'weight' => 55.0,
                'package_type' => 'باقة أساسية',
                'job_title' => 'خادمة للطبخ',
                'contract_type' => 'عقد شهري',
                'contract_fees' => 12000,
                'nationality' => 'سودانية',
                'service_type' => 'خادمة للطبخ',
                'experience_years' => 7,
                'status' => 'متاحة',
                'rating' => 4.9,
                'views_count' => 200,
                'reviews_count' => 18,
                'marital_status' => 'أعزب',
                'children_count' => 0,
                'work_type' => 'دوام جزئي',
                'languages' => 'العربية، الإنجليزية، الفرنسية',
                'skills' => 'الطبخ، إعداد الطعام، العناية بالمطبخ',
                'previous_experience' => 'خبرة 7 سنوات في الطبخ وإعداد الطعام',
                'photo' => 'maids/images/SGZ8T2FkpanC3YaQWx6N3jmJ3YoQzErG3e5EBC47.jpg',
                'image_path' => 'maids/images/SGZ8T2FkpanC3YaQWx6N3jmJ3YoQzErG3e5EBC47.jpg',
            ],
        ];
        
        foreach ($maidsData as $maidData) {
            $maid = Maid::create($maidData);
            
            $skills = [
                ['skill_name' => 'تنظيف المنزل', 'description' => 'تنظيف شامل للمنزل'],
                ['skill_name' => 'الطبخ', 'description' => 'إعداد وجبات متنوعة'],
                ['skill_name' => 'العناية بالأطفال', 'description' => 'رعاية الأطفال والتعليم'],
            ];
            
            foreach ($skills as $skill) {
                $maid->skills()->create($skill);
            }
        }
    }
    
    private function createPostsWithImages()
    {
        $postsData = [
            [
                'title' => 'نصائح لاختيار الخادمة المناسبة',
                'slug' => 'tips-choosing-right-maid',
                'excerpt' => 'دليل شامل لاختيار الخادمة المناسبة لمنزلك',
                'content' => 'هذا المقال يحتوي على نصائح مهمة لاختيار الخادمة المناسبة...',
                'featured_image' => 'blog/images/SGZ8T2FkpanC3YaQWx6N3jmJ3YoQzErG3e5EBC47.jpg',
                'status' => 'published',
                'is_featured' => true,
                'published_at' => now(),
                'meta_title' => 'نصائح لاختيار الخادمة المناسبة',
                'meta_description' => 'دليل شامل لاختيار الخادمة المناسبة لمنزلك',
            ],
            [
                'title' => 'حقوق وواجبات الخادمات',
                'slug' => 'maids-rights-responsibilities',
                'excerpt' => 'تعرف على حقوق وواجبات الخادمات في دولة الإمارات',
                'content' => 'هذا المقال يوضح حقوق وواجبات الخادمات...',
                'featured_image' => 'blog/images/SGZ8T2FkpanC3YaQWx6N3jmJ3YoQzErG3e5EBC47.jpg',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now(),
                'meta_title' => 'حقوق وواجبات الخادمات',
                'meta_description' => 'تعرف على حقوق وواجبات الخادمات في دولة الإمارات',
            ],
        ];
        
        $category = Category::first();
        
        foreach ($postsData as $postData) {
            $postData['category_id'] = $category->id;
            Post::create($postData);
        }
    }
    
    private function createCustomerReviews()
    {
        $reviewsData = [
            [
                'customer_name' => 'أحمد محمد',
                'customer_email' => 'ahmed@example.com',
                'customer_phone' => '+971501234567',
                'rating' => 5,
                'review_text' => 'خدمة ممتازة ومهنية عالية',
                'status' => 'active',
                'customer_image' => 'maids/images/SGZ8T2FkpanC3YaQWx6N3jmJ3YoQzErG3e5EBC47.jpg',
            ],
        ];
        
        foreach ($reviewsData as $reviewData) {
            CustomerReview::create($reviewData);
        }
    }
    
    private function createServiceRequests()
    {
        $requestsData = [
            [
                'name' => 'أحمد محمد',
                'email' => 'ahmed@example.com',
                'phone' => '+971501234567',
                'service_type' => 'خادمة منزلية',
                'message' => 'أحتاج خادمة منزلية للتنظيف والطبخ',
                'status' => 'pending',
            ],
        ];
        
        foreach ($requestsData as $requestData) {
            ServiceRequest::create($requestData);
        }
    }
    
    private function createChatData()
    {
        $chatRoom = ChatRoom::create([
            'visitor_name' => 'زائر',
            'visitor_email' => 'visitor@example.com',
            'status' => 'active',
            'unread_messages_count' => 0,
        ]);
        
        $messages = [
            [
                'chat_room_id' => $chatRoom->id,
                'sender_type' => 'visitor',
                'sender_name' => 'زائر',
                'message' => 'مرحباً، أريد الاستفسار عن الخدمات',
                'is_read' => false,
            ],
        ];
        
        foreach ($messages as $message) {
            ChatMessage::create($message);
        }
    }
}
