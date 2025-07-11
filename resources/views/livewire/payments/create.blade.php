<div>
    <h1 class="text-2xl font-bold mb-4">إضافة مدفوعات جديدة</h1>
    <form wire:submit.prevent="save" class="bg-white rounded shadow p-4 max-w-lg mx-auto">
        <div class="mb-2">
            <label class="block mb-1">المستخدم</label>
            <select wire:model="user_id" class="border rounded px-2 py-1 w-full">
                <option value="">اختر المستخدم</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-2">
            <label class="block mb-1">التسجيل</label>
            <select wire:model="enrollment_id" class="border rounded px-2 py-1 w-full">
                <option value="">اختر التسجيل</option>
                @foreach($enrollments as $enrollment)
                <option value="{{ $enrollment->id }}">{{ $enrollment->id }} - {{ $enrollment->user?->name }} - {{
                    $enrollment->course?->title }}</option>
                @endforeach
            </select>
            @error('enrollment_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-2">
            <label class="block mb-1">المبلغ</label>
            <input type="number" wire:model="amount" class="border rounded px-2 py-1 w-full" step="0.01" />
            @error('amount') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-2">
            <label class="block mb-1">الحالة</label>
            <select wire:model="status" class="border rounded px-2 py-1 w-full">
                <option value="pending">قيد الانتظار</option>
                <option value="paid">مدفوع</option>
                <option value="failed">فشل</option>
                <option value="refunded">مسترد</option>
            </select>
            @error('status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-2">
            <label class="block mb-1">طريقة الدفع</label>
            <input type="text" wire:model="payment_method" class="border rounded px-2 py-1 w-full" />
            @error('payment_method') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-2">
            <label class="block mb-1">رقم العملية</label>
            <input type="text" wire:model="transaction_id" class="border rounded px-2 py-1 w-full" />
            @error('transaction_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-2">
            <label class="block mb-1">تاريخ الدفع</label>
            <input type="datetime-local" wire:model="paid_at" class="border rounded px-2 py-1 w-full" />
            @error('paid_at') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4 flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">حفظ</button>
            <a href="{{ route('payments.index') }}" class="text-gray-600 hover:underline">إلغاء</a>
        </div>
    </form>
</div>
