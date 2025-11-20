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
                'service_type' => 'تنظيف وطبخ',
                'experience_years' => 5,
                'status' => 'متاحة',
                'rating' => 5,
                'views_count' => 150,
                'reviews_count' => 12,
                'marital_status' => 'متزوجة',
                'children_count' => 2,
                'work_type' => 'دوام كامل',
                'languages' => 'العربية، الإنجليزية',
                'skills' => 'تنظيف، طبخ، رعاية أطفال، غسيل ملابس',
                'previous_experience' => 'خبرة 5 سنوات في التنظيف والطبخ ورعاية الأطفال. تتميز بالدقة والأمانة.',
                'photo' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'skills_array' => ['تنظيف', 'طبخ', 'رعاية أطفال', 'غسيل ملابس'],
                'work_experience' => [
                    ['company' => 'عائلة أحمد', 'position' => 'خادمة منزلية', 'duration' => '3 سنوات', 'description' => 'تنظيف المنزل والطبخ ورعاية الأطفال'],
                    ['company' => 'عائلة محمد', 'position' => 'خادمة منزلية', 'duration' => '2 سنوات', 'description' => 'تنظيف شامل وإدارة المنزل'],
                ]
            ],
            [
                'name' => 'مريم أحمد',
                'age' => 32,
                'nationality' => 'سودانية',
                'service_type' => 'تنظيف شامل',
                'experience_years' => 7,
                'status' => 'متاحة',
                'rating' => 5,
                'views_count' => 200,
                'reviews_count' => 18,
                'marital_status' => 'أرملة',
                'children_count' => 3,
                'work_type' => 'دوام كامل',
                'languages' => 'العربية',
                'skills' => 'تنظيف، طبخ، غسيل ملابس، تنظيم',
                'previous_experience' => 'خبرة 7 سنوات في جميع أعمال المنزل. تتميز بالسرعة والدقة.',
                'photo' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'skills_array' => ['تنظيف', 'طبخ', 'غسيل ملابس', 'تنظيم'],
                'work_experience' => [
                    ['company' => 'عائلة سالم', 'position' => 'خادمة منزلية', 'duration' => '4 سنوات', 'description' => 'تنظيف شامل وطبخ يومي'],
                    ['company' => 'عائلة خالد', 'position' => 'خادمة منزلية', 'duration' => '3 سنوات', 'description' => 'إدارة المنزل الكامل'],
                ]
            ],
            [
                'name' => 'عائشة علي',
                'age' => 25,
                'nationality' => 'يمنية',
                'service_type' => 'رعاية أطفال',
                'experience_years' => 3,
                'status' => 'متاحة',
                'rating' => 4,
                'views_count' => 100,
                'reviews_count' => 8,
                'marital_status' => 'عزباء',
                'children_count' => 0,
                'work_type' => 'دوام جزئي',
                'languages' => 'العربية',
                'skills' => 'تنظيف، طبخ، رعاية أطفال',
                'previous_experience' => 'خبرة 3 سنوات في التنظيف والطبخ. تتميز بالحيوية والحماس.',
                'photo' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'skills_array' => ['تنظيف', 'طبخ', 'رعاية أطفال'],
                'work_experience' => [
                    ['company' => 'عائلة يوسف', 'position' => 'خادمة منزلية', 'duration' => '3 سنوات', 'description' => 'تنظيف وطبخ ورعاية أطفال'],
                ]
            ],
            [
                'name' => 'زينب حسن',
                'age' => 35,
                'nationality' => 'مصرية',
                'service_type' => 'إدارة منزل كامل',
                'experience_years' => 8,
                'status' => 'متاحة',
                'rating' => 5,
                'views_count' => 300,
                'reviews_count' => 25,
                'marital_status' => 'متزوجة',
                'children_count' => 4,
                'work_type' => 'دوام كامل',
                'languages' => 'العربية، الفرنسية',
                'skills' => 'تنظيف، طبخ، غسيل ملابس، تنظيم، رعاية أطفال',
                'previous_experience' => 'خبرة 8 سنوات في جميع أعمال المنزل. تتميز بالخبرة والكفاءة.',
                'photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'skills_array' => ['تنظيف', 'طبخ', 'غسيل ملابس', 'تنظيم', 'رعاية أطفال'],
                'work_experience' => [
                    ['company' => 'عائلة عبدالله', 'position' => 'خادمة منزلية', 'duration' => '5 سنوات', 'description' => 'إدارة المنزل الكامل'],
                    ['company' => 'عائلة سعد', 'position' => 'خادمة منزلية', 'duration' => '3 سنوات', 'description' => 'تنظيف وطبخ ورعاية أطفال'],
                ]
            ],
            [
                'name' => 'نور الدين',
                'age' => 29,
                'nationality' => 'سورية',
                'service_type' => 'تنظيف وطبخ',
                'experience_years' => 4,
                'status' => 'متاحة',
                'rating' => 4,
                'views_count' => 120,
                'reviews_count' => 10,
                'marital_status' => 'متزوجة',
                'children_count' => 1,
                'work_type' => 'دوام جزئي',
                'languages' => 'العربية، التركية',
                'skills' => 'تنظيف، طبخ، غسيل ملابس، تنظيم',
                'previous_experience' => 'خبرة 4 سنوات في التنظيف والطبخ. تتميز بالدقة والأناقة.',
                'photo' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'skills_array' => ['تنظيف', 'طبخ', 'غسيل ملابس', 'تنظيم'],
                'work_experience' => [
                    ['company' => 'عائلة محمود', 'position' => 'خادمة منزلية', 'duration' => '4 سنوات', 'description' => 'تنظيف شامل وطبخ يومي'],
                ]
            ],
        ];

        foreach ($maids as $maidData) {
            $skillsArray = $maidData['skills_array'];
            $workExperience = $maidData['work_experience'];
            unset($maidData['skills_array'], $maidData['work_experience']);

            $maid = Maid::updateOrCreate(
                ['name' => $maidData['name']],
                $maidData
            );

            // إضافة المهارات
            foreach ($skillsArray as $skill) {
                MaidSkill::updateOrCreate(
                    ['maid_id' => $maid->id, 'skill_name' => $skill],
                    ['skill_name' => $skill, 'description' => 'مهارة في ' . $skill]
                );
            }

            // إضافة الخبرة العملية
            foreach ($workExperience as $experience) {
                WorkExperience::updateOrCreate(
                    [
                        'maid_id' => $maid->id,
                        'company_name' => $experience['company'],
                        'position' => $experience['position']
                    ],
                    [
                        'maid_id' => $maid->id,
                        'company_name' => $experience['company'],
                        'position' => $experience['position'],
                        'start_date' => now()->subYears(rand(1, 5)),
                        'end_date' => now()->subMonths(rand(1, 12)),
                        'description' => $experience['description']
                    ]
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
                'rating' => 5,
                'description' => 'خدمة ممتازة! الخادمة كانت محترفة جداً ونظيفة. أنصح بالتعامل معهم.',
                'customer_photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'customer_location' => 'الرياض، المملكة العربية السعودية',
                'status' => 'active',
            ],
            [
                'customer_name' => 'فاطمة علي',
                'rating' => 5,
                'description' => 'أفضل خدمة تنظيف في الرياض. الخادمة كانت سريعة ودقيقة.',
                'customer_photo' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'customer_location' => 'جدة، المملكة العربية السعودية',
                'status' => 'active',
            ],
            [
                'customer_name' => 'محمد أحمد',
                'rating' => 4,
                'description' => 'خدمة جيدة جداً. الخادمة كانت مهذبة ومحترفة.',
                'customer_photo' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'customer_location' => 'الدمام، المملكة العربية السعودية',
                'status' => 'active',
            ],
            [
                'customer_name' => 'سارة محمد',
                'rating' => 5,
                'description' => 'خدمة رائعة! الخادمة كانت نظيفة جداً وطبخت أكل لذيذ.',
                'customer_photo' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'customer_location' => 'الرياض، المملكة العربية السعودية',
                'status' => 'active',
            ],
            [
                'customer_name' => 'خالد علي',
                'rating' => 5,
                'description' => 'أفضل خدمة في المنطقة. أنصح الجميع بالتعامل معهم.',
                'customer_photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'customer_location' => 'أبوظبي، الإمارات العربية المتحدة',
                'status' => 'active',
            ],
            [
                'customer_name' => 'نور الدين',
                'rating' => 4,
                'description' => 'خدمة ممتازة وسعر مناسب. الخادمة كانت مهذبة ومحترفة.',
                'customer_photo' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'customer_location' => 'دبي، الإمارات العربية المتحدة',
                'status' => 'active',
            ],
        ];

        foreach ($reviews as $review) {
            CustomerReview::updateOrCreate(
                [
                    'customer_name' => $review['customer_name'],
                    'description' => $review['description']
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
                'name' => 'أحمد محمد',
                'phone' => '0501234567',
                'service_type' => 'خادمه منزليه',
                'nationality' => 'سيرلنكا',
                'emirate' => 'دبي',
                'notes' => 'أحتاج خادمة لتنظيف المنزل يومياً',
                'status' => 'تحت المراجعه',
                'is_active' => true,
            ],
            [
                'name' => 'فاطمة علي',
                'phone' => '0501234568',
                'service_type' => 'طباخه',
                'nationality' => 'كينيا',
                'emirate' => 'ابوظبي',
                'notes' => 'أحتاج خادمة لطبخ الطعام اليومي',
                'status' => 'تحت المراجعه',
                'is_active' => true,
            ],
            [
                'name' => 'محمد أحمد',
                'phone' => '0501234569',
                'service_type' => 'جليسه اطفال',
                'nationality' => 'اندونسيا',
                'emirate' => 'الشارقه',
                'notes' => 'أحتاج خادمة لرعاية الأطفال أثناء العمل',
                'status' => 'تم التنفيذ',
                'is_active' => true,
            ],
        ];

        foreach ($requests as $request) {
            ServiceRequest::updateOrCreate(
                [
                    'name' => $request['name'],
                    'phone' => $request['phone']
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
                'visitor_name' => 'أحمد محمد',
                'visitor_email' => 'ahmed@example.com',
                'visitor_phone' => '0501234567',
                'session_id' => 'session_' . uniqid(),
                'status' => 'active',
                'type' => 'live_chat',
                'initial_message' => 'مرحباً، أريد الاستفسار عن خدماتكم',
                'assigned_admin' => 'mo.askary@gmail.com',
                'is_read' => true,
                'last_activity' => now(),
            ],
            [
                'visitor_name' => 'فاطمة علي',
                'visitor_email' => 'fatima@example.com',
                'visitor_phone' => '0501234568',
                'session_id' => 'session_' . uniqid(),
                'status' => 'active',
                'type' => 'live_chat',
                'initial_message' => 'أريد حجز خادمة لتنظيف المنزل',
                'assigned_admin' => 'mo.askary@gmail.com',
                'is_read' => false,
                'last_activity' => now()->subHours(2),
            ],
            [
                'visitor_name' => 'محمد أحمد',
                'visitor_email' => 'mohamed@example.com',
                'visitor_phone' => '0501234569',
                'session_id' => 'session_' . uniqid(),
                'status' => 'closed',
                'type' => 'leave_message',
                'initial_message' => 'شكراً لكم على الخدمة الممتازة',
                'assigned_admin' => 'mo.askary@gmail.com',
                'is_read' => true,
                'last_activity' => now()->subDays(1),
            ],
        ];

        foreach ($chatRooms as $roomData) {
            $room = ChatRoom::updateOrCreate(
                ['session_id' => $roomData['session_id']],
                $roomData
            );

            // إضافة رسائل تجريبية
            $messages = [
                [
                    'chat_room_id' => $room->id,
                    'sender_name' => $room->visitor_name,
                    'message' => $room->initial_message,
                    'sender_type' => 'visitor',
                    'is_read' => true,
                ],
                [
                    'chat_room_id' => $room->id,
                    'sender_name' => 'محمد عسكري',
                    'message' => 'مرحباً، كيف يمكنني مساعدتك؟',
                    'sender_type' => 'admin',
                    'is_read' => true,
                ],
            ];

            foreach ($messages as $message) {
                ChatMessage::updateOrCreate(
                    [
                        'chat_room_id' => $message['chat_room_id'],
                        'sender_name' => $message['sender_name'],
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
                'sort_order' => 1,
            ],
            [
                'name' => 'الطبخ',
                'slug' => 'cooking',
                'description' => 'وصفات ونصائح الطبخ',
                'color' => '#ff7b8a',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'رعاية الأطفال',
                'slug' => 'childcare',
                'description' => 'نصائح رعاية الأطفال',
                'color' => '#20bf6b',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        // إنشاء المواضيع لكل قسم بشكل منفصل
        $categoryPosts = [
            'cleaning-tips' => [
                [
                    'title' => 'أفضل طرق تنظيف المطبخ',
                    'slug' => 'blog-best-kitchen-cleaning-methods',
                    'excerpt' => 'نصائح مفيدة لتنظيف المطبخ بفعالية',
                    'content' => 'هذا المقال يحتوي على نصائح مفيدة لتنظيف المطبخ بفعالية وأمان...',
                    'featured_image' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'status' => 'published',
                ],
                [
                    'title' => 'تنظيف السجاد بطرق طبيعية',
                    'slug' => 'blog-natural-carpet-cleaning',
                    'excerpt' => 'طرق طبيعية لتنظيف السجاد بدون مواد كيميائية',
                    'content' => 'هذا المقال يحتوي على طرق طبيعية لتنظيف السجاد بدون مواد كيميائية...',
                    'featured_image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'status' => 'published',
                ],
            ],
            'cooking' => [
                [
                    'title' => 'وصفات سهلة للعشاء',
                    'slug' => 'blog-easy-dinner-recipes',
                    'excerpt' => 'وصفات سهلة وسريعة لعشاء لذيذ',
                    'content' => 'هذا المقال يحتوي على وصفات سهلة وسريعة لعشاء لذيذ...',
                    'featured_image' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'status' => 'published',
                ],
            ],
            'childcare' => [
                [
                    'title' => 'أفضل طرق تهدئة الأطفال',
                    'slug' => 'blog-calming-children-methods',
                    'excerpt' => 'طرق فعالة لتهدئة الأطفال',
                    'content' => 'هذا المقال يحتوي على طرق فعالة لتهدئة الأطفال...',
                    'featured_image' => 'https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'status' => 'published',
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            $category = Category::updateOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );

            // إنشاء مواضيع لكل قسم
            if (isset($categoryPosts[$categoryData['slug']])) {
                foreach ($categoryPosts[$categoryData['slug']] as $postData) {
                    BlogPost::updateOrCreate(
                        [
                            'category_id' => $category->id,
                            'slug' => $postData['slug']
                        ],
                        array_merge($postData, [
                            'published_at' => now()->subDays(rand(1, 30)),
                        ])
                    );
                }
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

        // إنشاء المواضيع لكل قسم بشكل منفصل
        $categoryPosts = [
            'cooking' => [
                [
                    'title' => 'وصفات سهلة لعشاء سريع',
                    'slug' => 'easy-dinner-recipes',
                    'excerpt' => 'وصفات سهلة وسريعة لعشاء لذيذ',
                    'content' => 'هذا المقال يحتوي على وصفات سهلة وسريعة لعشاء لذيذ...',
                    'featured_image' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'status' => 'published',
                    'is_featured' => true,
                ],
            ],
            'childcare' => [
                [
                    'title' => 'أفضل طرق تهدئة الأطفال',
                    'slug' => 'calming-children-methods',
                    'excerpt' => 'طرق فعالة لتهدئة الأطفال',
                    'content' => 'هذا المقال يحتوي على طرق فعالة لتهدئة الأطفال...',
                    'featured_image' => 'https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'status' => 'published',
                    'is_featured' => false,
                ],
            ],
            'home-tips' => [
                [
                    'title' => 'تنظيم المنزل بخطوات بسيطة',
                    'slug' => 'simple-home-organization',
                    'excerpt' => 'خطوات بسيطة لتنظيم المنزل',
                    'content' => 'هذا المقال يحتوي على خطوات بسيطة لتنظيم المنزل...',
                    'featured_image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'status' => 'published',
                    'is_featured' => true,
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            $category = Category::updateOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );

            // إنشاء مواضيع لكل قسم
            if (isset($categoryPosts[$categoryData['slug']])) {
                foreach ($categoryPosts[$categoryData['slug']] as $postData) {
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
}
