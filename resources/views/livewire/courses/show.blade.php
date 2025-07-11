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
    @endcan
    <a href="{{ route('courses.index') }}" class="ml-2 text-gray-600">رجوع | Back</a>
</div>
