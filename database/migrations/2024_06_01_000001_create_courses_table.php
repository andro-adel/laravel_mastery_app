<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * إنشاء جدول الدورات | Create the courses table
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id(); // معرف الدورة | Course ID
            $table->string('title'); // عنوان الدورة | Course title
            $table->text('description')->nullable(); // وصف الدورة | Course description
            $table->decimal('price', 8, 2)->default(0); // سعر الدورة | Course price
            $table->foreignId('instructor_id')->constrained('users')->onDelete('cascade'); // معرف المدرب | Instructor ID
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft'); // حالة الدورة | Course status
            $table->timestamps(); // تاريخ الإنشاء والتحديث | Created/Updated at
        });
    }

    /**
     * حذف جدول الدورات | Drop the courses table
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
