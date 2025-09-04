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
            // إضافة الأعمدة المفقودة إذا لم تكن موجودة
            if (!Schema::hasColumn('maids', 'religion')) {
                $table->string('religion')->after('image_path');
            }
            if (!Schema::hasColumn('maids', 'language')) {
                $table->string('language')->after('religion');
            }
            if (!Schema::hasColumn('maids', 'birth_date')) {
                $table->date('birth_date')->after('language');
            }
            if (!Schema::hasColumn('maids', 'age')) {
                $table->integer('age')->after('birth_date');
            }
            if (!Schema::hasColumn('maids', 'education')) {
                $table->string('education')->after('age');
            }
            if (!Schema::hasColumn('maids', 'height')) {
                $table->decimal('height', 5, 2)->nullable()->after('education');
            }
            if (!Schema::hasColumn('maids', 'weight')) {
                $table->decimal('weight', 5, 2)->nullable()->after('height');
            }
            if (!Schema::hasColumn('maids', 'package_type')) {
                $table->string('package_type')->after('weight');
            }
            if (!Schema::hasColumn('maids', 'job_title')) {
                $table->string('job_title')->after('package_type');
            }
            if (!Schema::hasColumn('maids', 'contract_type')) {
                $table->string('contract_type')->after('job_title');
            }
            if (!Schema::hasColumn('maids', 'contract_fees')) {
                $table->decimal('contract_fees', 10, 2)->after('contract_type');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('maids', function (Blueprint $table) {
            // حذف الأعمدة المضافة
            $columns = ['religion', 'language', 'birth_date', 'age', 'education', 
                       'height', 'weight', 'package_type', 'job_title', 'contract_type', 'contract_fees'];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('maids', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
