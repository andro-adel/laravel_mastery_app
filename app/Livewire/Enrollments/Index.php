<?php

namespace App\Livewire\Enrollments;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

/**
 * مكون عرض قائمة التسجيلات | Enrollments List Component
 */
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

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
     * عرض قائمة التسجيلات مع البحث والترتيب | Render enrollments list with search & sort
     */
    public function render()
    {
        $enrollments = Enrollment::with(['user', 'course'])
            ->when($this->search, function ($q) {
                $q->whereHas('user', fn($q2) => $q2->where('name', 'like', "%{$this->search}%"))
                  ->orWhereHas('course', fn($q2) => $q2->where('title', 'like', "%{$this->search}%"));
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.enrollments.index', [
            'enrollments' => $enrollments,
        ]);
    }
}
