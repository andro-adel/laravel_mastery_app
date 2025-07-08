<?php

use Livewire\Volt\Component;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    /**
     * Get the list of courses based on user role.
     * جلب قائمة الدورات حسب صلاحية المستخدم
     */
    public function getCoursesProperty()
    {
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            // Admin sees all courses | المدير يرى جميع الدورات
            return Course::latest()->paginate(10);
        } elseif ($user->hasRole('instructor')) {
            // Instructor sees only his courses | المدرس يرى دوراته فقط
            return Course::where('instructor_id', $user->id)->latest()->paginate(10);
        } else {
            // Student sees only published courses | الطالب يرى الدورات المنشورة فقط
            return Course::where('status', 'published')->latest()->paginate(10);
        }
    }

    /**
     * Delete a course by id.
     * حذف دورة حسب المعرف
     */
    public function delete($id)
    {
        $course = Course::findOrFail($id);
        // Authorize deletion | تحقق من الصلاحية
        $this->authorize('delete', $course);
        // Delete image if exists | حذف الصورة إذا وجدت
        if ($course->image_path && \Storage::disk('public')->exists($course->image_path)) {
            \Storage::disk('public')->delete($course->image_path);
        }
        $course->delete();
        session()->flash('success', __('Course deleted successfully! | تم حذف الدورة بنجاح!'));
    }
}; ?>

<div>
    <!-- Courses List | قائمة الدورات -->
    <h2 class="text-2xl font-bold mb-4">Courses | الدورات</h2>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @can('create', App\Models\Course::class)
    <!-- Add Course Button | زر إضافة دورة -->
    <a href="{{ route('courses.create') }}" class="btn btn-primary mb-4">Add Course | إضافة دورة</a>
    @endcan

    <table class="table-auto w-full border">
        <thead>
            <tr>
                <th>#</th>
                <th>Title | العنوان</th>
                <th>Instructor | المدرس</th>
                <th>Status | الحالة</th>
                <th>Actions | الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($this->courses as $course)
            <tr>
                <td>{{ $course->id }}</td>
                <td>{{ $course->title }}</td>
                <td>{{ $course->instructor->name ?? '-' }}</td>
                <td>{{ ucfirst($course->status) }}</td>
                <td>
                    <a href="{{ route('courses.show', $course) }}" class="btn btn-info btn-sm">Show | عرض</a>
                    @can('update', $course)
                    <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning btn-sm">Edit | تعديل</a>
                    @endcan
                    @can('delete', $course)
                    <button onclick="if(confirm('Are you sure? | هل أنت متأكد؟')) { @this.delete({{ $course->id }}) }"
                        class="btn btn-danger btn-sm">Delete | حذف</button>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination | ترقيم الصفحات -->
    <div class="mt-4">
        {{ $this->courses->links() }}
    </div>
</div>
