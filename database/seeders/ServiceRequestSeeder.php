<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServiceRequest;
use App\Models\User;
use App\Models\Maid;

class ServiceRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء طلبات خدمة وهمية
        $users = User::take(3)->get();
        $maids = Maid::take(5)->get();
        
        if ($users->count() > 0 && $maids->count() > 0) {
            foreach ($users as $user) {
                // كل مستخدم يتعامل مع 2-3 خادمات
                $randomMaids = $maids->random(rand(2, 3));
                
                foreach ($randomMaids as $maid) {
                    ServiceRequest::create([
                        'user_id' => $user->id,
                        'maid_id' => $maid->id,
                        'name' => $user->name,
                        'phone' => '0501234567',
                        'service_type' => 'خادمه منزليه',
                        'nationality' => 'الفلبين',
                        'emirate' => 'دبي',
                        'notes' => 'طلب خدمة وهمي للاختبار',
                        'status' => 'تم التنفيذ',
                        'is_active' => true,
                    ]);
                }
            }
        }
    }
}
