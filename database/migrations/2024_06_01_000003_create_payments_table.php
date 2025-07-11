<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * إنشاء جدول المدفوعات | Create the payments table
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // معرف الدفع | Payment ID
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // معرف المستخدم | User ID
            $table->foreignId('enrollment_id')->nullable()->constrained()->onDelete('cascade'); // معرف التسجيل | Enrollment ID
            $table->decimal('amount', 8, 2); // المبلغ | Amount
            $table->enum('status', ['pending', 'paid', 'failed', 'refunded'])->default('pending'); // حالة الدفع | Payment status
            $table->string('payment_method')->nullable(); // طريقة الدفع | Payment method
            $table->string('transaction_id')->nullable(); // رقم العملية | Transaction ID
            $table->timestamp('paid_at')->nullable(); // تاريخ الدفع | Paid at
            $table->timestamps(); // تاريخ الإنشاء والتحديث | Created/Updated at
        });
    }

    /**
     * حذف جدول المدفوعات | Drop the payments table
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
