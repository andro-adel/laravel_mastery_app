<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * إنشاء جدول الإشعارات | Create the notifications table
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id(); // معرف الإشعار | Notification ID
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // معرف المستخدم | User ID
            $table->string('type'); // نوع الإشعار | Notification type
            $table->json('data'); // بيانات الإشعار | Notification data
            $table->timestamp('read_at')->nullable(); // وقت القراءة | Read at
            $table->timestamps(); // تاريخ الإنشاء والتحديث | Created/Updated at
        });
    }

    /**
     * حذف جدول الإشعارات | Drop the notifications table
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
