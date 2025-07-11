<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;
use Illuminate\Support\Facades\Gate;

/**
 * لوحة تحكم المشرف | Admin Dashboard Component
 */
class Admin extends Component
{
    public $usersCount;
    public $coursesCount;
    public $enrollmentsCount;
    public $revenue;

    /**
     * تحميل الإحصائيات والتحقق من الصلاحية | Mount and check permission
     */
    public function mount()
    {
        abort_unless(Gate::allows('view dashboard'), 403);
        $this->usersCount = User::count();
        $this->coursesCount = Course::count();
        $this->enrollmentsCount = Enrollment::count();
        $this->revenue = Payment::where('status', 'paid')->sum('amount');
    }

    /**
     * عرض لوحة التحكم | Render dashboard
     */
    public function render()
    {
        return view('livewire.dashboard.admin');
    }
}
