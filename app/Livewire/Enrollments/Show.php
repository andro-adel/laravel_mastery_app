<?php

namespace App\Livewire\Enrollments;

use Livewire\Component;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Gate;

/**
 * مكون عرض تفاصيل تسجيل | Show Enrollment Component
 */
class Show extends Component
{
    public Enrollment $enrollment;
    public $confirmingDelete = false;

    /**
     * تحميل بيانات التسجيل | Mount enrollment
     */
    public function mount(Enrollment $enrollment)
    {
        $this->enrollment = $enrollment;
    }

    /**
     * عرض تفاصيل التسجيل | Render enrollment details
     */
    public function render()
    {
        return view('livewire.enrollments.show', [
            'enrollment' => $this->enrollment,
        ]);
    }

    public function confirmDelete()
    {
        abort_unless(Gate::allows('manage enrollments'), 403);
        $this->confirmingDelete = true;
    }
    public function delete()
    {
        abort_unless(Gate::allows('manage enrollments'), 403);
        $this->enrollment->delete();
        session()->flash('success', 'تم حذف التسجيل بنجاح | Enrollment deleted successfully');
        return redirect()->route('enrollments.index');
    }
}
