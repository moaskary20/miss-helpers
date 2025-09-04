<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Maid;

class UpdateMaidImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // تحديث جميع الخادمات لتشير إلى الصورة الموجودة
        $imagePath = 'maids/images/SGZ8T2FkpanC3YaQWx6N3jmJ3YoQzErG3e5EBC47.jpg';
        
        Maid::whereNull('image_path')->update(['image_path' => $imagePath]);
        
        $this->command->info('Updated all maids with image path: ' . $imagePath);
    }
}