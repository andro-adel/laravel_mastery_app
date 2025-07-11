<?php

namespace App\Livewire\Courses;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/**
 * مكون عرض قائمة الدورات | Courses List Component
 */
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $confirmingDeleteId = null;

    /**
     * تحديث الترتيب | Update sorting
     */
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    /**
     * عرض قائمة الدورات مع البحث والترتيب | Render courses list with search & sort
     */
    public function render()
    {
        $courses = Course::query()
            ->when($this->search, fn($q) => $q->where('title', 'like', "%{$this->search}%"))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.courses.index', [
            'courses' => $courses,
        ]);
    }

    /**
     * تفعيل نافذة التأكيد | Show delete confirmation for a course
     */
    public function confirmDelete($id)
    {
        $this->confirmingDeleteId = $id;
    }

    /**
     * حذف الدورة | Delete course
     */
    public function delete($id)
    {
        $course = Course::findOrFail($id);
        if (!Gate::allows('manage courses')) abort(403);
        $course->delete();
        session()->flash('success', 'تم حذف الدورة بنجاح | Course deleted successfully');
        $this->confirmingDeleteId = null;
    }
}
