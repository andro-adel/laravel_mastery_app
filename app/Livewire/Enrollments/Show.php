<?php

namespace App\Livewire\Enrollments;

use Livewire\Component;
use App\Models\Enrollment;

/**
 * مكون عرض تفاصيل تسجيل | Show Enrollment Component
 */
class Show extends Component
{
    public Enrollment $enrollment;

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
}
