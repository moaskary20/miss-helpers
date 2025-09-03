<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('maids', function (Blueprint $table) {
            // إضافة الحقول الجديدة
            $table->string('nationality')->nullable()->after('name');
            $table->string('service_type')->nullable()->after('nationality');
            $table->integer('experience_years')->nullable()->after('service_type');
            $table->string('status')->default('متاحة')->after('experience_years');
            $table->integer('rating')->default(0)->after('status');
            $table->integer('views_count')->default(0)->after('rating');
            $table->integer('reviews_count')->default(0)->after('views_count');
            $table->string('marital_status')->nullable()->after('reviews_count');
            $table->integer('children_count')->default(0)->after('marital_status');
            $table->string('work_type')->nullable()->after('children_count');
            $table->text('languages')->nullable()->after('work_type');
            $table->text('skills')->nullable()->after('languages');
            $table->text('previous_experience')->nullable()->after('skills');
            $table->string('photo')->nullable()->after('previous_experience');
            
            // إزالة الحقول القديمة
            $table->dropColumn([
                'video_path',
                'image_path', 
                'religion',
                'language',
                'birth_date',
                'education',
                'height',
                'weight',
                'package_type',
                'job_title',
                'contract_type',
                'contract_fees'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('maids', function (Blueprint $table) {
            // إعادة الحقول القديمة
            $table->string('video_path')->nullable();
            $table->string('image_path')->nullable();
            $table->string('religion');
            $table->string('language');
            $table->date('birth_date');
            $table->string('education');
            $table->decimal('height', 5, 2)->nullable();
            $table->decimal('weight', 5, 2)->nullable();
            $table->string('package_type');
            $table->string('job_title');
            $table->string('contract_type');
            $table->decimal('contract_fees', 10, 2);
            
            // إزالة الحقول الجديدة
            $table->dropColumn([
                'nationality',
                'service_type',
                'experience_years',
                'status',
                'rating',
                'views_count',
                'reviews_count',
                'marital_status',
                'children_count',
                'work_type',
                'languages',
                'skills',
                'previous_experience',
                'photo'
            ]);
        });
    }
};
