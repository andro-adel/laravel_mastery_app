<?php

use Livewire\Volt\Component;
use App\Models\Course;

new class extends Component {
    public Course $course;

    public function mount(Course $course)
    {
        $this->course = $course;
    }
}; ?>

<div>
    <!-- Course Details | تفاصيل الدورة -->
    <h2 class="text-2xl font-bold mb-4">Course Details | تفاصيل الدورة</h2>
    <div class="mb-4">
        <strong>Title | العنوان:</strong> {{ $course->title }}
    </div>
    <div class="mb-4">
        <strong>Description | الوصف:</strong> {{ $course->description }}
    </div>
    <div class="mb-4">
        <strong>Instructor | المدرس:</strong> {{ $course->instructor->name ?? '-' }}
    </div>
    <div class="mb-4">
        <strong>Status | الحالة:</strong> {{ ucfirst($course->status) }}
    </div>
    <div class="mb-4">
        <strong>Image | الصورة:</strong><br>
        @if ($course->image_path)
        <img src="{{ asset('storage/' . $course->image_path) }}" alt="Course Image" class="h-32">
        @else
        <span>No image | لا توجد صورة</span>
        @endif
    </div>
    <a href="{{ route('courses.index') }}" class="btn btn-secondary">Back | رجوع</a>
</div>
