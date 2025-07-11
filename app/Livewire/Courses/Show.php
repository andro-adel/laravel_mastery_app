<?php

namespace App\Livewire\Courses;

use Livewire\Component;
use App\Models\Course;

/**
 * مكون عرض تفاصيل دورة | Show Course Component
 */
class Show extends Component
{
    public Course $course;

    /**
     * تحميل بيانات الدورة | Mount course
     */
    public function mount(Course $course)
    {
        $this->course = $course;
    }

    /**
     * عرض تفاصيل الدورة | Render course details
     */
    public function render()
    {
        return view('livewire.courses.show', [
            'course' => $this->course,
        ]);
    }
}
