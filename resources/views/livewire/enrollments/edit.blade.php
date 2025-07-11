<div class="max-w-lg mx-auto">
    <h2 class="text-xl font-bold mb-4">تعديل بيانات التسجيل | Edit Enrollment</h2>
    @if (session('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-2">{{ session('success') }}</div>
    @endif
    <form wire:submit.prevent="update">
        <div class="mb-2">
            <label>الطالب | Student</label>
            <select wire:model.defer="user_id" class="border rounded w-full px-2 py-1">
                <option value="">اختر طالبًا | Select a student</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
        <div class="mb-2">
            <label>الدورة | Course</label>
            <select wire:model.defer="course_id" class="border rounded w-full px-2 py-1">
                <option value="">اختر دورة | Select a course</option>
                @foreach($courses as $course)
                <option value="{{ $course->id }}">{{ $course->title }}</option>
                @endforeach
            </select>
            @error('course_id') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
        <div class="mb-2">
            <label>الحالة | Status</label>
            <select wire:model.defer="status" class="border rounded w-full px-2 py-1">
                <option value="pending">قيد الانتظار | Pending</option>
                <option value="active">نشط | Active</option>
                <option value="cancelled">ملغي | Cancelled</option>
                <option value="completed">مكتمل | Completed</option>
            </select>
            @error('status') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">حفظ التعديلات | Save Changes</button>
        <a href="{{ route('enrollments.index') }}" class="ml-2 text-gray-600">إلغاء | Cancel</a>
    </form>
</div>
