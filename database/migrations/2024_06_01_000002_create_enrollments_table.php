<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * إنشاء جدول التسجيلات | Create the enrollments table
     */
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id(); // معرف التسجيل | Enrollment ID
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // معرف الطالب | Student ID
            $table->foreignId('course_id')->constrained()->onDelete('cascade'); // معرف الدورة | Course ID
            $table->enum('status', ['pending', 'active', 'cancelled', 'completed'])->default('pending'); // حالة التسجيل | Enrollment status
            $table->timestamps(); // تاريخ الإنشاء والتحديث | Created/Updated at
        });
    }

    /**
     * حذف جدول التسجيلات | Drop the enrollments table
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
