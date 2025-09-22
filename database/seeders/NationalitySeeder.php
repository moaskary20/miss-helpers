<?php

namespace Database\Seeders;

use App\Models\Maid;
use App\Models\Nationality;
use Illuminate\Database\Seeder;

class NationalitySeeder extends Seeder
{
    public function run(): void
    {
        // اجلب الجنسيات من الخادمات ضمن الباقة التقليدية فقط
        $names = Maid::where('package_type', 'الباقة التقليدية')
            ->distinct()
            ->pluck('nationality')
            ->filter()
            ->map(fn ($n) => trim($n))
            ->unique()
            ->values();

        foreach ($names as $name) {
            Nationality::updateOrCreate(['name' => $name], ['is_active' => true]);
        }
    }
}


