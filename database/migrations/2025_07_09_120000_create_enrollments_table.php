<?php
/**
 * Migration: Create enrollments table
 * English: Creates the enrollments table to link users and courses with payment status.
 * Arabic: ينشئ جدول التسجيلات لربط المستخدمين بالكورسات مع حالة الدفع.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('payment_status')->default('pending'); // paid, pending, failed
            $table->string('stripe_payment_id')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'course_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
