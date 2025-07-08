<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * English: Create the courses table for storing course data.
     * Arabic: إنشاء جدول الكورسات لتخزين بيانات الكورسات.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // English: Course name | Arabic: اسم الكورس
            $table->text('description')->nullable(); // English: Description | Arabic: الوصف
            $table->string('instructor'); // English: Instructor name | Arabic: اسم المدرب
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * English: Drop the courses table.
     * Arabic: حذف جدول الكورسات.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
