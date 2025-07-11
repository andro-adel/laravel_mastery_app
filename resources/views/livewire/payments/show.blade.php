<div>
    <h1 class="text-2xl font-bold mb-4">تفاصيل المدفوعات</h1>
    <div class="bg-white rounded shadow p-4">
        <div class="mb-2"><strong>المستخدم:</strong> {{ $payment->user?->name }}</div>
        <div class="mb-2"><strong>التسجيل:</strong> {{ $payment->enrollment_id }}</div>
        <div class="mb-2"><strong>المبلغ:</strong> {{ $payment->amount }}</div>
        <div class="mb-2"><strong>الحالة:</strong> {{ $payment->status }}</div>
        <div class="mb-2"><strong>طريقة الدفع:</strong> {{ $payment->payment_method }}</div>
        <div class="mb-2"><strong>رقم العملية:</strong> {{ $payment->transaction_id }}</div>
        <div class="mb-2"><strong>تاريخ الدفع:</strong> {{ $payment->paid_at }}</div>
    </div>
    <div class="mt-4">
        <a href="{{ route('payments.index') }}" class="text-blue-600 hover:underline">&larr; العودة لقائمة المدفوعات</a>
    </div>
</div>
