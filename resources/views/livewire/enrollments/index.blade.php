<div>
    <!-- بحث وترتيب التسجيلات | Enrollments search & sort -->
    <div class="flex items-center mb-4">
        <input type="text" wire:model.debounce.500ms="search"
            placeholder="بحث عن طالب أو دورة... | Search student or course..." class="border rounded px-2 py-1 mr-2">
        <a href="{{ route('enrollments.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded"
            @if(!auth()->user()->can('manage users')) style="display:none" @endif>
            إضافة تسجيل | Add Enrollment
        </a>
    </div>
    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="cursor-pointer" wire:click="sortBy('user_id')">الطالب | Student</th>
                <th class="cursor-pointer" wire:click="sortBy('course_id')">الدورة | Course</th>
                <th class="cursor-pointer" wire:click="sortBy('status')">الحالة | Status</th>
                <th>إجراءات | Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($enrollments as $enrollment)
            <tr>
                <td>{{ $enrollment->user->name ?? '-' }}</td>
                <td>{{ $enrollment->course->title ?? '-' }}</td>
                <td>{{ __($enrollment->status) }}</td>
                <td>
                    <a href="{{ route('enrollments.show', $enrollment) }}" class="text-green-600">عرض | Show</a>
                    @can('manage users')
                    <a href="{{ route('enrollments.edit', $enrollment) }}" class="text-blue-600 ml-2">تعديل | Edit</a>
                    @endcan
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">لا توجد تسجيلات | No enrollments found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        {{ $enrollments->links() }}
    </div>
</div>
