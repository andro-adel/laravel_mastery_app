<div>
    <h1 class="text-2xl font-bold mb-4">قائمة المدفوعات</h1>
    <div class="mb-4 flex items-center gap-2">
        <input type="text" wire:model.debounce.500ms="search" placeholder="بحث باسم المستخدم أو رقم العملية..."
            class="border rounded px-2 py-1" />
        <a href="{{ route('payments.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">إضافة مدفوعات</a>
    </div>
    @if($confirmingDeleteId)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded shadow-lg max-w-sm w-full">
            <h3 class="text-lg font-bold mb-4">تأكيد الحذف | Confirm Delete</h3>
            <p class="mb-4">هل أنت متأكد أنك تريد حذف هذه الدفعة؟ لا يمكن التراجع عن هذا الإجراء.<br>Are you sure you want to delete this payment? This action cannot be undone.</p>
            <div class="flex justify-end gap-2">
                <button wire:click="delete({{ $confirmingDeleteId }})" class="bg-red-600 text-white px-4 py-2 rounded">تأكيد الحذف | Confirm</button>
                <button wire:click="$set('confirmingDeleteId', null)" class="bg-gray-300 px-4 py-2 rounded">إلغاء | Cancel</button>
            </div>
        </div>
    </div>
    @endif
    @if (session('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mt-4">{{ session('success') }}</div>
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
                    @can('manage payments')
                    <a href="{{ route('payments.edit', $payment) }}" class="text-blue-600">تعديل | Edit</a>
                    <button wire:click="confirmDelete({{ $payment->id }})" class="text-red-600 ml-2">حذف | Delete</button>
                    @endcan
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
