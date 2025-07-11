<?php

namespace App\Livewire\Enrollments;

use Livewire\Component;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Gate;
use App\Events\StudentEnrolled;

/**
 * مكون إضافة تسجيل جديد | Create Enrollment Component
 */
class Create extends Component
{
    public $user_id;
    public $course_id;
    public $status = 'pending';

    /**
     * التحقق من الصلاحية عند تحميل الصفحة | Check permission on mount
     */
    public function mount()
    {
        abort_unless(Gate::allows('manage users'), 403);
    }

    /**
     * إضافة تسجيل جديد | Store new enrollment
     */
    public function save()
    {
        $this->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'status' => 'required|in:pending,active,cancelled,completed',
        ]);

        $enrollment = Enrollment::create([
            'user_id' => $this->user_id,
            'course_id' => $this->course_id,
            'status' => $this->status,
        ]);

        // إطلاق حدث تسجيل طالب في دورة | Fire student enrolled event
        event(new StudentEnrolled($enrollment));

        session()->flash('success', 'تمت إضافة التسجيل بنجاح | Enrollment added successfully');
        return redirect()->route('enrollments.index');
    }

    /**
     * عرض نموذج الإضافة | Render create form
     */
    public function render()
    {
        return view('livewire.enrollments.create', [
            'users' => User::all(),
            'courses' => Course::all(),
        ]);
    }
}
