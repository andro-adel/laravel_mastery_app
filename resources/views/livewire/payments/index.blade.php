<div>
    <h1 class="text-2xl font-bold mb-4">قائمة المدفوعات</h1>
    <div class="mb-4 flex items-center gap-2">
        <input type="text" wire:model.debounce.500ms="search" placeholder="بحث باسم المستخدم أو رقم العملية..."
            class="border rounded px-2 py-1" />
        <a href="{{ route('payments.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">إضافة مدفوعات</a>
    </div>
    @if (session()->has('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif
    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="cursor-pointer" wire:click="sortBy('id')">#</th>
                <th class="cursor-pointer" wire:click="sortBy('user_id')">المستخدم</th>
                <th class="cursor-pointer" wire:click="sortBy('enrollment_id')">التسجيل</th>
                <th class="cursor-pointer" wire:click="sortBy('amount')">المبلغ</th>
                <th class="cursor-pointer" wire:click="sortBy('status')">الحالة</th>
                <th class="cursor-pointer" wire:click="sortBy('payment_method')">طريقة الدفع</th>
                <th class="cursor-pointer" wire:click="sortBy('transaction_id')">رقم العملية</th>
                <th class="cursor-pointer" wire:click="sortBy('paid_at')">تاريخ الدفع</th>
                <th>إجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
            <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->user?->name }}</td>
                <td>{{ $payment->enrollment_id }}</td>
                <td>{{ $payment->amount }}</td>
                <td>{{ $payment->status }}</td>
                <td>{{ $payment->payment_method }}</td>
                <td>{{ $payment->transaction_id }}</td>
                <td>{{ $payment->paid_at }}</td>
                <td>
                    <a href="{{ route('payments.show', $payment) }}" class="text-blue-600 hover:underline">عرض</a>
                    <a href="{{ route('payments.edit', $payment) }}" class="text-green-600 hover:underline">تعديل</a>
                    <a href="#" wire:click.prevent="confirmDelete({{ $payment->id }})"
                        class="text-red-600 hover:underline">حذف</a>
                    @if($confirmingDeleteId === $payment->id)
                    <span class="ml-2 text-sm text-gray-700">هل أنت متأكد؟
                        <button wire:click.prevent="delete({{ $payment->id }})"
                            class="bg-red-600 text-white px-2 py-1 rounded ml-1">تأكيد</button>
                        <button wire:click.prevent="$set('confirmingDeleteId', null)"
                            class="bg-gray-300 px-2 py-1 rounded">إلغاء</button>
                    </span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">لا توجد مدفوعات</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        {{ $payments->links() }}
    </div>
</div>
