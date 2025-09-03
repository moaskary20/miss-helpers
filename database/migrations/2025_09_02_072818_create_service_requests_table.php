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
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->enum('service_type', [
                'خادمه منزليه',
                'جليسه اطفال',
                'طباخه',
                'مقدمه رعاية',
                'سائق'
            ]);
            $table->enum('nationality', [
                'سيرلنكا',
                'كينيا',
                'اقيوبيا',
                'اندونسيا',
                'الفلبين',
                'اوعندا',
                'مينمار'
            ]);
            $table->enum('emirate', [
                'راس الخيمة',
                'ام القوين',
                'الشارقه',
                'عجمان',
                'ابوظبي',
                'دبي',
                'العين'
            ]);
            $table->text('notes')->nullable();
            $table->enum('status', ['تحت المراجعه', 'تم التنفيذ'])->default('تحت المراجعه');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};
