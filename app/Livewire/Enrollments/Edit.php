<?php

namespace App\Livewire\Enrollments;

use Livewire\Component;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Gate;

/**
 * مكون تعديل تسجيل | Edit Enrollment Component
 */
class Edit extends Component
{
    public Enrollment $enrollment;
    public $user_id;
    public $course_id;
    public $status;

    /**
     * تحميل بيانات التسجيل والتحقق من الصلاحية | Mount and check permission
     */
    public function mount(Enrollment $enrollment)
    {
        abort_unless(Gate::allows('manage users'), 403);
        $this->enrollment = $enrollment;
        $this->user_id = $enrollment->user_id;
        $this->course_id = $enrollment->course_id;
        $this->status = $enrollment->status;
    }

    /**
     * حفظ التعديلات | Save changes
     */
    public function update()
    {
        $this->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'status' => 'required|in:pending,active,cancelled,completed',
        ]);

        $this->enrollment->update([
            'user_id' => $this->user_id,
            'course_id' => $this->course_id,
            'status' => $this->status,
        ]);

        session()->flash('success', 'تم تحديث التسجيل بنجاح | Enrollment updated successfully');
        return redirect()->route('enrollments.index');
    }

    /**
     * عرض نموذج التعديل | Render edit form
     */
    public function render()
    {
        return view('livewire.enrollments.edit', [
            'users' => User::all(),
            'courses' => Course::all(),
        ]);
    }
}
