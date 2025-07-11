<div class="max-w-lg mx-auto">
    <h2 class="text-xl font-bold mb-4">تفاصيل الدورة | Course Details</h2>
    <div class="mb-2"><strong>العنوان | Title:</strong> {{ $course->title }}</div>
    <div class="mb-2"><strong>الوصف | Description:</strong> {{ $course->description }}</div>
    <div class="mb-2"><strong>المدرب | Instructor:</strong> {{ $course->instructor->name ?? '-' }}</div>
    <div class="mb-2"><strong>السعر | Price:</strong> {{ $course->price }}</div>
    <div class="mb-2"><strong>الحالة | Status:</strong> {{ __($course->status) }}</div>
    <div class="mb-2"><strong>تاريخ الإنشاء | Created at:</strong> {{ $course->created_at->format('Y-m-d') }}</div>
    @can('manage courses')
    <a href="{{ route('courses.edit', $course) }}" class="bg-blue-600 text-white px-4 py-2 rounded">تعديل | Edit</a>
    <button wire:click="confirmDelete" class="bg-red-600 text-white px-4 py-2 rounded ml-2">حذف | Delete</button>
    @endcan
    <a href="{{ route('courses.index') }}" class="ml-2 text-gray-600">رجوع | Back</a>

    @if($confirmingDelete)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded shadow-lg max-w-sm w-full">
            <h3 class="text-lg font-bold mb-4">تأكيد الحذف | Confirm Delete</h3>
            <p class="mb-4">هل أنت متأكد أنك تريد حذف هذه الدورة؟ لا يمكن التراجع عن هذا الإجراء.<br>Are you sure you
                want to delete this course? This action cannot be undone.</p>
            <div class="flex justify-end gap-2">
                <button wire:click="delete" class="bg-red-600 text-white px-4 py-2 rounded">تأكيد الحذف |
                    Confirm</button>
                <button wire:click="confirmingDelete = false" class="bg-gray-300 px-4 py-2 rounded">إلغاء |
                    Cancel</button>
            </div>
        </div>
    </div>
    @endif
    @if (session('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mt-4">{{ session('success') }}</div>
    @endif
</div>
