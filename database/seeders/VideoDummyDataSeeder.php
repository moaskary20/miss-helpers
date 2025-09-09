<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Maid;
use Illuminate\Support\Facades\Storage;

class VideoDummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء مجلد الفيديوهات إذا لم يكن موجوداً
        $videoDir = 'maids/videos';
        if (!Storage::disk('public')->exists($videoDir)) {
            Storage::disk('public')->makeDirectory($videoDir);
        }

        // إنشاء ملفات فيديو وهمية
        $this->createDummyVideoFiles();

        // تحديث الخادمات بمسارات الفيديو
        $this->updateMaidsWithVideoPaths();
    }

    /**
     * إنشاء ملفات فيديو وهمية
     */
    private function createDummyVideoFiles(): void
    {
        $videoContent = $this->getDummyVideoContent();
        
        for ($i = 1; $i <= 10; $i++) {
            $fileName = "dummy_video_{$i}.mp4";
            $filePath = "maids/videos/{$fileName}";
            
            // إنشاء محتوى الفيديو الوهمي
            $content = str_replace('{VIDEO_NUMBER}', $i, $videoContent);
            
            // حفظ الملف
            Storage::disk('public')->put($filePath, $content);
            
            echo "Created dummy video file: {$fileName}\n";
        }
    }

    /**
     * تحديث الخادمات بمسارات الفيديو
     */
    private function updateMaidsWithVideoPaths(): void
    {
        $maids = Maid::all();
        
        foreach ($maids as $index => $maid) {
            $videoNumber = ($index % 10) + 1; // استخدام رقم من 1 إلى 10
            $videoPath = "maids/videos/dummy_video_{$videoNumber}.mp4";
            
            $maid->update(['video_path' => $videoPath]);
            
            echo "Updated maid ID {$maid->id} ({$maid->name}) with video: {$videoPath}\n";
        }
    }

    /**
     * محتوى الفيديو الوهمي
     */
    private function getDummyVideoContent(): string
    {
        return '<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فيديو وهمي للخادمة {VIDEO_NUMBER}</title>
    <style>
        body { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-family: "Tajawal", Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            text-align: center;
            overflow: hidden;
        }
        .video-container {
            background: rgba(0,0,0,0.8);
            padding: 60px 40px;
            border-radius: 25px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.5);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255,255,255,0.1);
            max-width: 500px;
            width: 90%;
        }
        .play-button {
            font-size: 80px;
            margin-bottom: 30px;
            animation: pulse 2s infinite;
            cursor: pointer;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        h1 { 
            margin: 0 0 20px 0; 
            font-size: 28px; 
            font-weight: 700;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        p { 
            margin: 15px 0 0 0; 
            opacity: 0.9; 
            font-size: 16px;
            line-height: 1.6;
        }
        .video-info {
            margin-top: 25px;
            padding: 15px;
            background: rgba(255,255,255,0.1);
            border-radius: 15px;
            font-size: 14px;
        }
        .duration {
            color: #4ecdc4;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="video-container">
        <div class="play-button">▶️</div>
        <h1>فيديو الخادمة #{VIDEO_NUMBER}</h1>
        <p>هذا فيديو تجريبي لعرض الفيديو في صفحة الخادمة</p>
        <div class="video-info">
            <div>📹 فيديو وهمي للاختبار</div>
            <div class="duration">⏱️ المدة: 2:30 دقيقة</div>
            <div>🎬 الجودة: HD 720p</div>
        </div>
    </div>
    
    <script>
        // إضافة تفاعل عند النقر على زر التشغيل
        document.querySelector(".play-button").addEventListener("click", function() {
            this.style.transform = "scale(1.2)";
            setTimeout(() => {
                this.style.transform = "scale(1)";
            }, 200);
        });
    </script>
</body>
</html>';
    }
}
