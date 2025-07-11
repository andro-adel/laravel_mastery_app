<?php

namespace App\Livewire\Courses;

use Livewire\Component;
use App\Models\Course;
use Illuminate\Support\Facades\Gate;

/**
 * مكون عرض تفاصيل دورة | Show Course Component
 */
class Show extends Component
{
    public Course $course;
    public $confirmingDelete = false;

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

    /**
     * تفعيل نافذة التأكيد | Show delete confirmation
     */
    public function confirmDelete()
    {
        abort_unless(Gate::allows('manage courses'), 403);
        $this->confirmingDelete = true;
    }

    /**
     * حذف الدورة | Delete course
     */
    public function delete()
    {
        abort_unless(Gate::allows('manage courses'), 403);
        $this->course->delete();
        session()->flash('success', 'تم حذف الدورة بنجاح | Course deleted successfully');
        return redirect()->route('courses.index');
    }
}
