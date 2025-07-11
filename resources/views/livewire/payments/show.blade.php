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
    @can('manage payments')
    <a href="{{ route('payments.edit', $payment) }}" class="bg-blue-600 text-white px-4 py-2 rounded">تعديل | Edit</a>
    <button wire:click="confirmDelete" class="bg-red-600 text-white px-4 py-2 rounded ml-2">حذف | Delete</button>
    @endcan
    <a href="{{ route('payments.index') }}" class="ml-2 text-gray-600">رجوع | Back</a>
    @if($confirmingDelete)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded shadow-lg max-w-sm w-full">
            <h3 class="text-lg font-bold mb-4">تأكيد الحذف | Confirm Delete</h3>
            <p class="mb-4">هل أنت متأكد أنك تريد حذف هذه الدفعة؟ لا يمكن التراجع عن هذا الإجراء.<br>Are you sure you want to delete this payment? This action cannot be undone.</p>
            <div class="flex justify-end gap-2">
                <button wire:click="delete" class="bg-red-600 text-white px-4 py-2 rounded">تأكيد الحذف | Confirm</button>
                <button wire:click="confirmingDelete = false" class="bg-gray-300 px-4 py-2 rounded">إلغاء | Cancel</button>
            </div>
        </div>
    </div>
    @endif
    @if (session('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mt-4">{{ session('success') }}</div>
    @endif
</div>
