<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Post;

class BlogDemoSeeder extends Seeder
{
    public function run(): void
    {
        $categories = collect([
            ['name' => 'الطبخ', 'color' => '#6c5ce7'],
            ['name' => 'رعاية الأطفال', 'color' => '#ff7b8a'],
            ['name' => 'نصائح المنزل', 'color' => '#20bf6b'],
        ])->map(function ($c, $i) {
            return Category::firstOrCreate([
                'slug' => Str::slug($c['name'])
            ], [
                'name' => $c['name'],
                'description' => $c['name'].' - قسم تجريبي',
                'color' => $c['color'],
                'is_active' => true,
                'sort_order' => $i + 1,
            ]);
        });

        $posts = [
            ['title' => 'وصفات سهلة لعشاء سريع', 'cat' => 0, 'img' => 'blog1.jpg'],
            ['title' => 'أفضل طرق تهدئة الأطفال', 'cat' => 1, 'img' => 'blog2.jpg'],
            ['title' => 'تنظيم المنزل بخطوات بسيطة', 'cat' => 2, 'img' => 'blog3.jpg'],
            ['title' => 'أطعمة صحية للعائلة', 'cat' => 0, 'img' => 'blog4.jpg'],
            ['title' => 'أنشطة تعليمية للأطفال', 'cat' => 1, 'img' => 'blog5.jpg'],
            ['title' => 'روتين تنظيف أسبوعي', 'cat' => 2, 'img' => 'blog6.jpg'],
        ];

        foreach ($posts as $p) {
            $category = $categories[$p['cat']];
            $path = 'posts/'.$p['img'];

            // إن لم تكن الصورة موجودة في التخزين العام، انسخ من public/images
            if (!Storage::disk('public')->exists($path)) {
                $publicPath = public_path('images/'.$p['img']);
                if (file_exists($publicPath)) {
                    Storage::disk('public')->put($path, file_get_contents($publicPath));
                }
            }

            Post::firstOrCreate([
                'slug' => Str::slug($p['title'])
            ], [
                'category_id' => $category->id,
                'title' => $p['title'],
                'excerpt' => 'مقال تجريبي لاختبار واجهة السلايدر.',
                'content' => 'هذا المحتوى التجريبي يهدف إلى اختبار عرض مواضيع المدونة في الصفحة الرئيسية.' ,
                'featured_image' => $path,
                'status' => 'published',
                'is_featured' => true,
                'published_at' => now(),
                'views_count' => rand(10, 200),
            ]);
        }
    }
}
