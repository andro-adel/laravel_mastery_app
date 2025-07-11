<div>
    <!-- بحث وترتيب الدورات | Courses search & sort -->
    <div class="flex items-center mb-4">
        <input type="text" wire:model.debounce.500ms="search" placeholder="بحث عن دورة... | Search courses..."
            class="border rounded px-2 py-1 mr-2">
        <a href="{{ route('courses.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded"
            @if(!auth()->user()->can('manage courses')) style="display:none" @endif>
            إضافة دورة | Add Course
        </a>
    </div>
    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="cursor-pointer" wire:click="sortBy('title')">العنوان | Title</th>
                <th class="cursor-pointer" wire:click="sortBy('instructor_id')">المدرب | Instructor</th>
                <th class="cursor-pointer" wire:click="sortBy('price')">السعر | Price</th>
                <th class="cursor-pointer" wire:click="sortBy('status')">الحالة | Status</th>
                <th>إجراءات | Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $course)
            <tr>
                <td><a href="{{ route('courses.show', $course) }}">{{ $course->title }}</a></td>
                <td>{{ $course->instructor->name ?? '-' }}</td>
                <td>{{ $course->price }}</td>
                <td>{{ __($course->status) }}</td>
                <td>
                    @can('manage courses')
                    <a href="{{ route('courses.edit', $course) }}" class="text-blue-600">تعديل | Edit</a>
                    @endcan
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">لا توجد دورات | No courses found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        {{ $courses->links() }}
    </div>
</div>
