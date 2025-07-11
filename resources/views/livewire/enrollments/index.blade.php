<div>
    <h1 class="text-2xl font-bold mb-4">قائمة التسجيلات | Enrollments List</h1>
    <div class="mb-4 flex flex-col sm:flex-row items-center gap-2">
        <input type="text" wire:model.debounce.500ms="search" placeholder="بحث بالمستخدم أو الدورة... | Search by user or course..."
            class="border rounded px-2 py-1 flex-1 min-w-[200px]" />
        @can('manage enrollments')
        <a href="{{ route('enrollments.create') }}" class="bg-blue-600 hover:bg-blue-700 transition text-white px-4 py-2 rounded shadow">
            <span>➕</span> إضافة تسجيل | Add Enrollment
        </a>
        @endcan
    </div>
    @if($confirmingDeleteId)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded shadow-lg max-w-sm w-full">
            <h3 class="text-lg font-bold mb-4">تأكيد الحذف | Confirm Delete</h3>
            <p class="mb-4">هل أنت متأكد أنك تريد حذف هذا التسجيل؟ لا يمكن التراجع عن هذا الإجراء.<br>Are you sure you want to delete this enrollment? This action cannot be undone.</p>
            <div class="flex justify-end gap-2">
                <button wire:click="delete({{ $confirmingDeleteId }})" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow">تأكيد الحذف | Confirm</button>
                <button wire:click="$set('confirmingDeleteId', null)" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">إلغاء | Cancel</button>
            </div>
        </div>
    </div>
    @endif
    @if (session('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mt-4 shadow">{{ session('success') }}</div>
    @endif
    <div class="overflow-x-auto">
    <table class="min-w-full bg-white border rounded shadow-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="cursor-pointer px-3 py-2" wire:click="sortBy('id')">#</th>
                <th class="cursor-pointer px-3 py-2" wire:click="sortBy('user_id')">👤 المستخدم | User</th>
                <th class="cursor-pointer px-3 py-2" wire:click="sortBy('course_id')">📚 الدورة | Course</th>
                <th class="cursor-pointer px-3 py-2" wire:click="sortBy('status')">🔖 الحالة | Status</th>
                <th class="cursor-pointer px-3 py-2" wire:click="sortBy('created_at')">📅 تاريخ التسجيل | Date</th>
                <th class="px-3 py-2">⚙️ إجراءات | Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($enrollments as $enrollment)
            <tr class="hover:bg-blue-50 transition">
                <td class="px-3 py-2">{{ $enrollment->id }}</td>
                <td class="px-3 py-2"><a href="{{ route('users.show', $enrollment->user) }}" class="text-blue-700 hover:underline">{{ $enrollment->user->name ?? '-' }}</a></td>
                <td class="px-3 py-2"><a href="{{ route('courses.show', $enrollment->course) }}" class="text-blue-700 hover:underline">{{ $enrollment->course->title ?? '-' }}</a></td>
                <td class="px-3 py-2">{{ __($enrollment->status) }}</td>
                <td class="px-3 py-2">{{ $enrollment->created_at->format('Y-m-d') }}</td>
                <td class="px-3 py-2">
                    <a href="{{ route('enrollments.show', $enrollment) }}" class="inline-block bg-green-400 hover:bg-green-500 text-white px-3 py-1 rounded shadow transition">عرض | Show</a>
                    @can('manage enrollments')
                    <a href="{{ route('enrollments.edit', $enrollment) }}" class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded shadow ml-2 transition">تعديل | Edit</a>
                    <button wire:click="confirmDelete({{ $enrollment->id }})" class="inline-block bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded shadow ml-2 transition">حذف | Delete</button>
                    @endcan
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-4 text-gray-500">لا توجد تسجيلات | No enrollments found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    </div>
    <div class="mt-4">
        {{ $enrollments->links() }}
    </div>
</div>
