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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            // Course title | عنوان الدورة
            $table->string('title');
            // Course description | وصف الدورة
            $table->text('description');
            // Path to featured image | مسار صورة الدورة المميزة
            $table->string('image_path')->nullable();
            // Instructor user id (foreign key) | رقم معرف المدرس (مفتاح خارجي)
            $table->unsignedBigInteger('instructor_id');
            // Course status (e.g. draft, published) | حالة الدورة (مثلاً: مسودة، منشورة)
            $table->string('status')->default('draft');
            $table->timestamps();

            // Foreign key constraint for instructor_id | قيد المفتاح الخارجي للمدرس
            $table->foreign('instructor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
