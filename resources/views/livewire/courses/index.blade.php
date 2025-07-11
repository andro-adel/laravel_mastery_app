<div>
    <!-- بحث وترتيب الدورات | Courses search & sort -->
    <div class="flex flex-col sm:flex-row items-center mb-4 gap-2">
        <input type="text" wire:model.debounce.500ms="search" placeholder="بحث عن دورة... | Search courses..."
            class="border rounded px-2 py-1 flex-1 min-w-[200px]">
        @can('manage courses')
        <a href="{{ route('courses.create') }}" class="bg-blue-600 hover:bg-blue-700 transition text-white px-4 py-2 rounded shadow">
            <span>➕</span> إضافة دورة | Add Course
        </a>
        @endcan
    </div>
    <div class="overflow-x-auto">
    <table class="min-w-full bg-white border rounded shadow-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="cursor-pointer px-3 py-2" wire:click="sortBy('title')">📚 العنوان | Title</th>
                <th class="cursor-pointer px-3 py-2" wire:click="sortBy('instructor_id')">👤 المدرب | Instructor</th>
                <th class="cursor-pointer px-3 py-2" wire:click="sortBy('price')">💵 السعر | Price</th>
                <th class="cursor-pointer px-3 py-2" wire:click="sortBy('status')">🔖 الحالة | Status</th>
                <th class="px-3 py-2">⚙️ إجراءات | Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $course)
            <tr class="hover:bg-blue-50 transition">
                <td class="px-3 py-2"><a href="{{ route('courses.show', $course) }}" class="text-blue-700 hover:underline">{{ $course->title }}</a></td>
                <td class="px-3 py-2">{{ $course->instructor->name ?? '-' }}</td>
                <td class="px-3 py-2">{{ $course->price }}</td>
                <td class="px-3 py-2">{{ __($course->status) }}</td>
                <td class="px-3 py-2">
                    @can('manage courses')
                    <a href="{{ route('courses.edit', $course) }}" class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded shadow transition">تعديل | Edit</a>
                    <button wire:click="confirmDelete({{ $course->id }})" class="inline-block bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded shadow ml-2 transition">حذف | Delete</button>
                    @endcan
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-4 text-gray-500">لا توجد دورات | No courses found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    </div>
    <div class="mt-4">
        {{ $courses->links() }}
    </div>
    @if($confirmingDeleteId)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded shadow-lg max-w-sm w-full">
            <h3 class="text-lg font-bold mb-4">تأكيد الحذف | Confirm Delete</h3>
            <p class="mb-4">هل أنت متأكد أنك تريد حذف هذه الدورة؟ لا يمكن التراجع عن هذا الإجراء.<br>Are you sure you want to delete this course? This action cannot be undone.</p>
            <div class="flex justify-end gap-2">
                <button wire:click="delete({{ $confirmingDeleteId }})"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow">تأكيد الحذف | Confirm</button>
                <button wire:click="$set('confirmingDeleteId', null)" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">إلغاء | Cancel</button>
            </div>
        </div>
    </div>
    @endif
    @if (session('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mt-4 shadow">{{ session('success') }}</div>
    @endif
</div>
