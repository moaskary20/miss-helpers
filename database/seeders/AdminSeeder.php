<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default permissions
        $permissions = [
            // Maids module
            ['name' => 'maids.manage', 'display_name' => 'إدارة الخادمات', 'description' => 'عرض وإدارة الخادمات', 'module' => 'maids'],
            
            // Blog module
            ['name' => 'blog.manage', 'display_name' => 'إدارة المدونة', 'description' => 'عرض وإدارة المواضيع', 'module' => 'blog'],
            
            // Categories module
            ['name' => 'categories.manage', 'display_name' => 'إدارة الأقسام', 'description' => 'عرض وإدارة الأقسام', 'module' => 'categories'],
            
            // Customer Reviews module
            ['name' => 'customer_reviews.manage', 'display_name' => 'إدارة آراء العملاء', 'description' => 'عرض وإدارة آراء العملاء', 'module' => 'customer_reviews'],
            
            // Service Requests module
            ['name' => 'service_requests.manage', 'display_name' => 'إدارة الطلبات', 'description' => 'عرض وإدارة طلبات الخدمة', 'module' => 'service_requests'],
            
            // Chat module
            ['name' => 'chat.manage', 'display_name' => 'إدارة الشات', 'description' => 'عرض وإدارة الشات', 'module' => 'chat'],
            
            // Users module
            ['name' => 'users.manage', 'display_name' => 'إدارة المستخدمين', 'description' => 'عرض وإدارة المستخدمين', 'module' => 'users'],
            
            // System module
            ['name' => 'system.manage', 'display_name' => 'إدارة النظام', 'description' => 'إدارة إعدادات النظام', 'module' => 'system'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission['name']],
                $permission
            );
        }

        // Create default role permissions
        $rolePermissions = [
            // Super Admin - Full access to everything
            ['role' => 'super_admin', 'permission_name' => 'maids.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => true],
            ['role' => 'super_admin', 'permission_name' => 'blog.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => true],
            ['role' => 'super_admin', 'permission_name' => 'categories.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => true],
            ['role' => 'super_admin', 'permission_name' => 'customer_reviews.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => true],
            ['role' => 'super_admin', 'permission_name' => 'service_requests.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => true],
            ['role' => 'super_admin', 'permission_name' => 'chat.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => true],
            ['role' => 'super_admin', 'permission_name' => 'users.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => true],
            ['role' => 'super_admin', 'permission_name' => 'system.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => true],
            
            // Admin - Full access except system
            ['role' => 'admin', 'permission_name' => 'maids.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => true],
            ['role' => 'admin', 'permission_name' => 'blog.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => true],
            ['role' => 'admin', 'permission_name' => 'categories.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => true],
            ['role' => 'admin', 'permission_name' => 'customer_reviews.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => true],
            ['role' => 'admin', 'permission_name' => 'service_requests.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => true],
            ['role' => 'admin', 'permission_name' => 'chat.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => true],
            ['role' => 'admin', 'permission_name' => 'users.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => false, 'can_delete' => false],
            ['role' => 'admin', 'permission_name' => 'system.manage', 'can_view' => true, 'can_create' => false, 'can_edit' => false, 'can_delete' => false],
            
            // Moderator - Limited permissions
            ['role' => 'moderator', 'permission_name' => 'maids.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => false],
            ['role' => 'moderator', 'permission_name' => 'blog.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => false],
            ['role' => 'moderator', 'permission_name' => 'categories.manage', 'can_view' => true, 'can_create' => false, 'can_edit' => false, 'can_delete' => false],
            ['role' => 'moderator', 'permission_name' => 'customer_reviews.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => false],
            ['role' => 'moderator', 'permission_name' => 'service_requests.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => false],
            ['role' => 'moderator', 'permission_name' => 'chat.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => false],
            ['role' => 'moderator', 'permission_name' => 'users.manage', 'can_view' => true, 'can_create' => false, 'can_edit' => false, 'can_delete' => false],
            
            // Editor - Basic permissions
            ['role' => 'editor', 'permission_name' => 'maids.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => false],
            ['role' => 'editor', 'permission_name' => 'blog.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => false],
            ['role' => 'editor', 'permission_name' => 'categories.manage', 'can_view' => true, 'can_create' => false, 'can_edit' => false, 'can_delete' => false],
            ['role' => 'editor', 'permission_name' => 'customer_reviews.manage', 'can_view' => true, 'can_create' => true, 'can_edit' => true, 'can_delete' => false],
            ['role' => 'editor', 'permission_name' => 'service_requests.manage', 'can_view' => true, 'can_create' => false, 'can_edit' => true, 'can_delete' => false],
            ['role' => 'editor', 'permission_name' => 'chat.manage', 'can_view' => true, 'can_create' => false, 'can_edit' => true, 'can_delete' => false],
        ];

        foreach ($rolePermissions as $rolePermission) {
            RolePermission::updateOrCreate(
                ['role' => $rolePermission['role'], 'permission_name' => $rolePermission['permission_name']],
                $rolePermission
            );
        }

        // Create default super admin user
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'مدير النظام',
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'phone' => '0501234567',
                'role' => 'super_admin',
                'status' => 'active',
                'password' => 'password123',
                'email_verified_at' => now(),
            ]
        );

        // Create default admin user
        User::updateOrCreate(
            ['email' => 'manager@admin.com'],
            [
                'name' => 'مدير الموقع',
                'username' => 'manager',
                'email' => 'manager@admin.com',
                'phone' => '0501234568',
                'role' => 'admin',
                'status' => 'active',
                'password' => 'password123',
                'email_verified_at' => now(),
            ]
        );

        // Create default moderator user
        User::updateOrCreate(
            ['email' => 'moderator@admin.com'],
            [
                'name' => 'مشرف الموقع',
                'username' => 'moderator',
                'email' => 'moderator@admin.com',
                'phone' => '0501234569',
                'role' => 'moderator',
                'status' => 'active',
                'password' => 'password123',
                'email_verified_at' => now(),
            ]
        );

        // Create default editor user
        User::updateOrCreate(
            ['email' => 'editor@admin.com'],
            [
                'name' => 'محرر الموقع',
                'username' => 'editor',
                'email' => 'editor@admin.com',
                'phone' => '0501234570',
                'role' => 'editor',
                'status' => 'active',
                'password' => 'password123',
                'email_verified_at' => now(),
            ]
        );
    }
}
