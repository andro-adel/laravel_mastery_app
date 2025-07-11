<div class="max-w-lg mx-auto">
    <h2 class="text-xl font-bold mb-4">تفاصيل التسجيل | Enrollment Details</h2>
    <div class="mb-2"><strong>الطالب | Student:</strong> {{ $enrollment->user->name ?? '-' }}</div>
    <div class="mb-2"><strong>الدورة | Course:</strong> {{ $enrollment->course->title ?? '-' }}</div>
    <div class="mb-2"><strong>الحالة | Status:</strong> {{ __($enrollment->status) }}</div>
    <div class="mb-2"><strong>تاريخ الإنشاء | Created at:</strong> {{ $enrollment->created_at->format('Y-m-d') }}</div>
    @can('manage users')
    <a href="{{ route('enrollments.edit', $enrollment) }}" class="bg-blue-600 text-white px-4 py-2 rounded">تعديل |
        Edit</a>
    @endcan
    <a href="{{ route('enrollments.index') }}" class="ml-2 text-gray-600">رجوع | Back</a>
</div>
