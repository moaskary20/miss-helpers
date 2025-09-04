<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Maid;
use App\Models\MaidSkill;
use App\Models\WorkExperience;
use App\Models\CustomerReview;
use App\Models\ServiceRequest;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Post;
use App\Models\Permission;
use App\Models\RolePermission;

class CompleteDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('بدء إنشاء البيانات الشاملة...');

        // 1. إنشاء المستخدمين
        $this->createUsers();
        
        // 2. إنشاء الخادمات
        $this->createMaids();
        
        // 3. إنشاء آراء العملاء
        $this->createCustomerReviews();
        
        // 4. إنشاء طلبات الخدمة
        $this->createServiceRequests();
        
        // 5. إنشاء غرف الشات والرسائل
        $this->createChatData();
        
        // 6. إنشاء المدونات
        $this->createBlogData();
        
        // 7. إنشاء الأقسام والمواضيع
        $this->createCategoriesAndPosts();

        $this->command->info('تم إنشاء جميع البيانات بنجاح!');
    }

    private function createUsers()
    {
        $this->command->info('إنشاء المستخدمين...');

        // إنشاء الصلاحيات
        $permissions = [
            ['name' => 'maids.manage', 'display_name' => 'إدارة الخادمات', 'description' => 'عرض وإدارة الخادمات', 'module' => 'maids'],
            ['name' => 'blog.manage', 'display_name' => 'إدارة المدونة', 'description' => 'عرض وإدارة المواضيع', 'module' => 'blog'],
            ['name' => 'categories.manage', 'display_name' => 'إدارة الأقسام', 'description' => 'عرض وإدارة الأقسام', 'module' => 'categories'],
            ['name' => 'customer_reviews.manage', 'display_name' => 'إدارة آراء العملاء', 'description' => 'عرض وإدارة آراء العملاء', 'module' => 'customer_reviews'],
            ['name' => 'service_requests.manage', 'display_name' => 'إدارة الطلبات', 'description' => 'عرض وإدارة طلبات الخدمة', 'module' => 'service_requests'],
            ['name' => 'chat.manage', 'display_name' => 'إدارة الشات', 'description' => 'عرض وإدارة الشات', 'module' => 'chat'],
            ['name' => 'users.manage', 'display_name' => 'إدارة المستخدمين', 'description' => 'عرض وإدارة المستخدمين', 'module' => 'users'],
            ['name' => 'system.manage', 'display_name' => 'إدارة النظام', 'description' => 'إدارة إعدادات النظام', 'module' => 'system'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission['name']],
                $permission
            );
        }

        // إنشاء صلاحيات الأدوار
        $rolePermissions = [
            ['role' => 'super_admin', 'permission_name' => 'maids.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => true],
            ['role' => 'super_admin', 'permission_name' => 'blog.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => true],
            ['role' => 'super_admin', 'permission_name' => 'categories.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => true],
            ['role' => 'super_admin', 'permission_name' => 'customer_reviews.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => true],
            ['role' => 'super_admin', 'permission_name' => 'service_requests.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => true],
            ['role' => 'super_admin', 'permission_name' => 'chat.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => true],
            ['role' => 'super_admin', 'permission_name' => 'users.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => true],
            ['role' => 'super_admin', 'permission_name' => 'system.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => true],
        ];

        foreach ($rolePermissions as $rolePermission) {
            RolePermission::updateOrCreate(
                ['role' => $rolePermission['role'], 'permission_name' => $rolePermission['permission_name']],
                $rolePermission
            );
        }

        // إنشاء المستخدم الرئيسي
        User::updateOrCreate(
            ['email' => 'mo.askary@gmail.com'],
            [
                'name' => 'محمد عسكري',
                'username' => 'moaskary',
                'email' => 'mo.askary@gmail.com',
                'phone' => '0501234567',
                'role' => 'super_admin',
                'status' => 'active',
                'password' => Hash::make('newpassword'),
                'email_verified_at' => now(),
            ]
        );

        // إنشاء مستخدمين إضافيين
        $users = [
            [
                'name' => 'أحمد محمد',
                'username' => 'ahmed_mohamed',
                'email' => 'ahmed@example.com',
                'phone' => '0501234568',
                'role' => 'admin',
                'status' => 'active',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'فاطمة علي',
                'username' => 'fatima_ali',
                'email' => 'fatima@example.com',
                'phone' => '0501234569',
                'role' => 'moderator',
                'status' => 'active',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'سارة أحمد',
                'username' => 'sara_ahmed',
                'email' => 'sara@example.com',
                'phone' => '0501234570',
                'role' => 'editor',
                'status' => 'active',
                'password' => Hash::make('password123'),
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                array_merge($userData, ['email_verified_at' => now()])
            );
        }
    }

    private function createMaids()
    {
        $this->command->info('إنشاء الخادمات...');

        $maids = [
            [
                'name' => 'فاطمة محمد',
                'age' => 28,
                'nationality' => 'مصرية',
                'experience_years' => 5,
                'hourly_rate' => 25.00,
                'phone' => '0501234567',
                'email' => 'fatima@example.com',
                'address' => 'الرياض، المملكة العربية السعودية',
                'bio' => 'خادمة محترفة مع خبرة 5 سنوات في التنظيف والطبخ ورعاية الأطفال. تتميز بالدقة والأمانة.',
                'status' => 'available',
                'image' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'skills' => ['تنظيف', 'طبخ', 'رعاية أطفال', 'غسيل ملابس'],
                'work_experience' => [
                    ['company' => 'عائلة أحمد', 'position' => 'خادمة منزلية', 'duration' => '3 سنوات', 'description' => 'تنظيف المنزل والطبخ ورعاية الأطفال'],
                    ['company' => 'عائلة محمد', 'position' => 'خادمة منزلية', 'duration' => '2 سنوات', 'description' => 'تنظيف شامل وإدارة المنزل'],
                ]
            ],
            [
                'name' => 'مريم أحمد',
                'age' => 32,
                'nationality' => 'سودانية',
                'experience_years' => 7,
                'hourly_rate' => 30.00,
                'phone' => '0501234568',
                'email' => 'mariam@example.com',
                'address' => 'جدة، المملكة العربية السعودية',
                'bio' => 'خادمة محترفة مع خبرة 7 سنوات في جميع أعمال المنزل. تتميز بالسرعة والدقة.',
                'status' => 'available',
                'image' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'skills' => ['تنظيف', 'طبخ', 'غسيل ملابس', 'تنظيم'],
                'work_experience' => [
                    ['company' => 'عائلة سالم', 'position' => 'خادمة منزلية', 'duration' => '4 سنوات', 'description' => 'تنظيف شامل وطبخ يومي'],
                    ['company' => 'عائلة خالد', 'position' => 'خادمة منزلية', 'duration' => '3 سنوات', 'description' => 'إدارة المنزل الكامل'],
                ]
            ],
            [
                'name' => 'عائشة علي',
                'age' => 25,
                'nationality' => 'يمنية',
                'experience_years' => 3,
                'hourly_rate' => 20.00,
                'phone' => '0501234569',
                'email' => 'aisha@example.com',
                'address' => 'الدمام، المملكة العربية السعودية',
                'bio' => 'خادمة شابة مع خبرة 3 سنوات في التنظيف والطبخ. تتميز بالحيوية والحماس.',
                'status' => 'available',
                'image' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'skills' => ['تنظيف', 'طبخ', 'رعاية أطفال'],
                'work_experience' => [
                    ['company' => 'عائلة يوسف', 'position' => 'خادمة منزلية', 'duration' => '3 سنوات', 'description' => 'تنظيف وطبخ ورعاية أطفال'],
                ]
            ],
            [
                'name' => 'زينب حسن',
                'age' => 35,
                'nationality' => 'مصرية',
                'experience_years' => 8,
                'hourly_rate' => 35.00,
                'phone' => '0501234570',
                'email' => 'zainab@example.com',
                'address' => 'الرياض، المملكة العربية السعودية',
                'bio' => 'خادمة محترفة مع خبرة 8 سنوات في جميع أعمال المنزل. تتميز بالخبرة والكفاءة.',
                'status' => 'available',
                'image' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'skills' => ['تنظيف', 'طبخ', 'غسيل ملابس', 'تنظيم', 'رعاية أطفال'],
                'work_experience' => [
                    ['company' => 'عائلة عبدالله', 'position' => 'خادمة منزلية', 'duration' => '5 سنوات', 'description' => 'إدارة المنزل الكامل'],
                    ['company' => 'عائلة سعد', 'position' => 'خادمة منزلية', 'duration' => '3 سنوات', 'description' => 'تنظيف وطبخ ورعاية أطفال'],
                ]
            ],
            [
                'name' => 'نور الدين',
                'age' => 29,
                'nationality' => 'سورية',
                'experience_years' => 4,
                'hourly_rate' => 28.00,
                'phone' => '0501234571',
                'email' => 'nour@example.com',
                'address' => 'الرياض، المملكة العربية السعودية',
                'bio' => 'خادمة محترفة مع خبرة 4 سنوات في التنظيف والطبخ. تتميز بالدقة والأناقة.',
                'status' => 'available',
                'image' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'skills' => ['تنظيف', 'طبخ', 'غسيل ملابس', 'تنظيم'],
                'work_experience' => [
                    ['company' => 'عائلة محمود', 'position' => 'خادمة منزلية', 'duration' => '4 سنوات', 'description' => 'تنظيف شامل وطبخ يومي'],
                ]
            ],
        ];

        foreach ($maids as $maidData) {
            $skills = $maidData['skills'];
            $workExperience = $maidData['work_experience'];
            unset($maidData['skills'], $maidData['work_experience']);

            $maid = Maid::updateOrCreate(
                ['email' => $maidData['email']],
                $maidData
            );

            // إضافة المهارات
            foreach ($skills as $skill) {
                MaidSkill::updateOrCreate(
                    ['maid_id' => $maid->id, 'skill' => $skill],
                    ['skill' => $skill]
                );
            }

            // إضافة الخبرة العملية
            foreach ($workExperience as $experience) {
                WorkExperience::updateOrCreate(
                    [
                        'maid_id' => $maid->id,
                        'company' => $experience['company'],
                        'position' => $experience['position']
                    ],
                    $experience
                );
            }
        }
    }

    private function createCustomerReviews()
    {
        $this->command->info('إنشاء آراء العملاء...');

        $reviews = [
            [
                'customer_name' => 'أحمد محمد',
                'customer_email' => 'ahmed@example.com',
                'rating' => 5,
                'review_text' => 'خدمة ممتازة! الخادمة كانت محترفة جداً ونظيفة. أنصح بالتعامل معهم.',
                'maid_id' => 1,
                'status' => 'approved',
            ],
            [
                'customer_name' => 'فاطمة علي',
                'customer_email' => 'fatima@example.com',
                'rating' => 5,
                'review_text' => 'أفضل خدمة تنظيف في الرياض. الخادمة كانت سريعة ودقيقة.',
                'maid_id' => 2,
                'status' => 'approved',
            ],
            [
                'customer_name' => 'محمد أحمد',
                'customer_email' => 'mohamed@example.com',
                'rating' => 4,
                'review_text' => 'خدمة جيدة جداً. الخادمة كانت مهذبة ومحترفة.',
                'maid_id' => 3,
                'status' => 'approved',
            ],
            [
                'customer_name' => 'سارة محمد',
                'customer_email' => 'sara@example.com',
                'rating' => 5,
                'review_text' => 'خدمة رائعة! الخادمة كانت نظيفة جداً وطبخت أكل لذيذ.',
                'maid_id' => 4,
                'status' => 'approved',
            ],
            [
                'customer_name' => 'خالد علي',
                'customer_email' => 'khalid@example.com',
                'rating' => 5,
                'review_text' => 'أفضل خدمة في المنطقة. أنصح الجميع بالتعامل معهم.',
                'maid_id' => 5,
                'status' => 'approved',
            ],
            [
                'customer_name' => 'نور الدين',
                'customer_email' => 'nour@example.com',
                'rating' => 4,
                'review_text' => 'خدمة ممتازة وسعر مناسب. الخادمة كانت مهذبة ومحترفة.',
                'maid_id' => 1,
                'status' => 'approved',
            ],
        ];

        foreach ($reviews as $review) {
            CustomerReview::updateOrCreate(
                [
                    'customer_email' => $review['customer_email'],
                    'maid_id' => $review['maid_id']
                ],
                $review
            );
        }
    }

    private function createServiceRequests()
    {
        $this->command->info('إنشاء طلبات الخدمة...');

        $requests = [
            [
                'customer_name' => 'أحمد محمد',
                'customer_email' => 'ahmed@example.com',
                'customer_phone' => '0501234567',
                'service_type' => 'تنظيف',
                'description' => 'أحتاج خادمة لتنظيف المنزل يومياً',
                'preferred_date' => now()->addDays(1),
                'preferred_time' => '09:00',
                'address' => 'الرياض، حي النرجس',
                'status' => 'pending',
            ],
            [
                'customer_name' => 'فاطمة علي',
                'customer_email' => 'fatima@example.com',
                'customer_phone' => '0501234568',
                'service_type' => 'طبخ',
                'description' => 'أحتاج خادمة لطبخ الطعام اليومي',
                'preferred_date' => now()->addDays(2),
                'preferred_time' => '10:00',
                'address' => 'جدة، حي الزهراء',
                'status' => 'pending',
            ],
            [
                'customer_name' => 'محمد أحمد',
                'customer_email' => 'mohamed@example.com',
                'customer_phone' => '0501234569',
                'service_type' => 'رعاية أطفال',
                'description' => 'أحتاج خادمة لرعاية الأطفال أثناء العمل',
                'preferred_date' => now()->addDays(3),
                'preferred_time' => '08:00',
                'address' => 'الدمام، حي الفيصلية',
                'status' => 'pending',
            ],
        ];

        foreach ($requests as $request) {
            ServiceRequest::updateOrCreate(
                [
                    'customer_email' => $request['customer_email'],
                    'preferred_date' => $request['preferred_date']
                ],
                $request
            );
        }
    }

    private function createChatData()
    {
        $this->command->info('إنشاء بيانات الشات...');

        // إنشاء غرف الشات
        $chatRooms = [
            [
                'name' => 'الدعم الفني',
                'description' => 'غرفة الدعم الفني للعملاء',
                'type' => 'support',
                'status' => 'active',
            ],
            [
                'name' => 'الاستفسارات العامة',
                'description' => 'غرفة الاستفسارات العامة',
                'type' => 'general',
                'status' => 'active',
            ],
        ];

        foreach ($chatRooms as $roomData) {
            $room = ChatRoom::updateOrCreate(
                ['name' => $roomData['name']],
                $roomData
            );

            // إضافة رسائل تجريبية
            $messages = [
                [
                    'room_id' => $room->id,
                    'sender_name' => 'أحمد محمد',
                    'sender_email' => 'ahmed@example.com',
                    'message' => 'مرحباً، أريد الاستفسار عن خدماتكم',
                    'sender_type' => 'customer',
                ],
                [
                    'room_id' => $room->id,
                    'sender_name' => 'محمد عسكري',
                    'sender_email' => 'mo.askary@gmail.com',
                    'message' => 'مرحباً أحمد، كيف يمكنني مساعدتك؟',
                    'sender_type' => 'admin',
                ],
                [
                    'room_id' => $room->id,
                    'sender_name' => 'أحمد محمد',
                    'sender_email' => 'ahmed@example.com',
                    'message' => 'أريد حجز خادمة لتنظيف المنزل',
                    'sender_type' => 'customer',
                ],
                [
                    'room_id' => $room->id,
                    'sender_name' => 'محمد عسكري',
                    'sender_email' => 'mo.askary@gmail.com',
                    'message' => 'ممتاز! يمكنك حجز الخادمة من خلال صفحة الخادمات',
                    'sender_type' => 'admin',
                ],
            ];

            foreach ($messages as $message) {
                ChatMessage::updateOrCreate(
                    [
                        'room_id' => $message['room_id'],
                        'sender_email' => $message['sender_email'],
                        'message' => $message['message'],
                        'created_at' => now()->subHours(rand(1, 24))
                    ],
                    $message
                );
            }
        }
    }

    private function createBlogData()
    {
        $this->command->info('إنشاء بيانات المدونة...');

        // إنشاء أقسام المدونة
        $categories = [
            [
                'name' => 'نصائح التنظيف',
                'slug' => 'cleaning-tips',
                'description' => 'نصائح ومعلومات مفيدة للتنظيف',
                'color' => '#6c5ce7',
                'is_active' => true,
            ],
            [
                'name' => 'الطبخ',
                'slug' => 'cooking',
                'description' => 'وصفات ونصائح الطبخ',
                'color' => '#ff7b8a',
                'is_active' => true,
            ],
            [
                'name' => 'رعاية الأطفال',
                'slug' => 'childcare',
                'description' => 'نصائح رعاية الأطفال',
                'color' => '#20bf6b',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $categoryData) {
            $category = BlogCategory::updateOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );

            // إنشاء مواضيع لكل قسم
            $posts = [
                [
                    'title' => 'أفضل طرق تنظيف المطبخ',
                    'slug' => 'best-kitchen-cleaning-methods',
                    'excerpt' => 'نصائح مفيدة لتنظيف المطبخ بفعالية',
                    'content' => 'هذا المقال يحتوي على نصائح مفيدة لتنظيف المطبخ بفعالية وأمان...',
                    'featured_image' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'status' => 'published',
                    'is_featured' => true,
                ],
                [
                    'title' => 'تنظيف السجاد بطرق طبيعية',
                    'slug' => 'natural-carpet-cleaning',
                    'excerpt' => 'طرق طبيعية لتنظيف السجاد بدون مواد كيميائية',
                    'content' => 'هذا المقال يحتوي على طرق طبيعية لتنظيف السجاد بدون مواد كيميائية...',
                    'featured_image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'status' => 'published',
                    'is_featured' => false,
                ],
            ];

            foreach ($posts as $postData) {
                BlogPost::updateOrCreate(
                    [
                        'category_id' => $category->id,
                        'slug' => $postData['slug']
                    ],
                    array_merge($postData, [
                        'published_at' => now()->subDays(rand(1, 30)),
                        'views_count' => rand(10, 200),
                    ])
                );
            }
        }
    }

    private function createCategoriesAndPosts()
    {
        $this->command->info('إنشاء الأقسام والمواضيع...');

        // إنشاء الأقسام
        $categories = [
            [
                'name' => 'الطبخ',
                'slug' => 'cooking',
                'description' => 'قسم الطبخ والوصفات',
                'color' => '#6c5ce7',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'رعاية الأطفال',
                'slug' => 'childcare',
                'description' => 'قسم رعاية الأطفال',
                'color' => '#ff7b8a',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'نصائح المنزل',
                'slug' => 'home-tips',
                'description' => 'نصائح مفيدة للمنزل',
                'color' => '#20bf6b',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($categories as $categoryData) {
            $category = Category::updateOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );

            // إنشاء مواضيع لكل قسم
            $posts = [
                [
                    'title' => 'وصفات سهلة لعشاء سريع',
                    'slug' => 'easy-dinner-recipes',
                    'excerpt' => 'وصفات سهلة وسريعة لعشاء لذيذ',
                    'content' => 'هذا المقال يحتوي على وصفات سهلة وسريعة لعشاء لذيذ...',
                    'featured_image' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'status' => 'published',
                    'is_featured' => true,
                ],
                [
                    'title' => 'أفضل طرق تهدئة الأطفال',
                    'slug' => 'calming-children-methods',
                    'excerpt' => 'طرق فعالة لتهدئة الأطفال',
                    'content' => 'هذا المقال يحتوي على طرق فعالة لتهدئة الأطفال...',
                    'featured_image' => 'https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'status' => 'published',
                    'is_featured' => false,
                ],
                [
                    'title' => 'تنظيم المنزل بخطوات بسيطة',
                    'slug' => 'simple-home-organization',
                    'excerpt' => 'خطوات بسيطة لتنظيم المنزل',
                    'content' => 'هذا المقال يحتوي على خطوات بسيطة لتنظيم المنزل...',
                    'featured_image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'status' => 'published',
                    'is_featured' => true,
                ],
            ];

            foreach ($posts as $postData) {
                Post::updateOrCreate(
                    [
                        'category_id' => $category->id,
                        'slug' => $postData['slug']
                    ],
                    array_merge($postData, [
                        'published_at' => now()->subDays(rand(1, 30)),
                        'views_count' => rand(10, 200),
                    ])
                );
            }
        }
    }
}
