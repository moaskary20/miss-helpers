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
        Schema::table('customer_reviews', function (Blueprint $table) {
            // إضافة الحقول الجديدة
            $table->string('customer_photo')->nullable()->after('customer_image');
            $table->string('customer_location')->nullable()->after('customer_photo');
            $table->string('status')->default('active')->after('is_active');
            
            // إزالة الحقول القديمة
            $table->dropColumn([
                'customer_image',
                'job_title',
                'service_received',
                'is_active',
                'sort_order'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_reviews', function (Blueprint $table) {
            // إعادة الحقول القديمة
            $table->string('customer_image')->nullable();
            $table->string('job_title');
            $table->string('service_received');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            
            // إزالة الحقول الجديدة
            $table->dropColumn([
                'customer_photo',
                'customer_location',
                'status'
            ]);
        });
    }
};
