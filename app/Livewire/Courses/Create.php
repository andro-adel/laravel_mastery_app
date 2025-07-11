<?php

namespace App\Livewire\Courses;

use Livewire\Component;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/**
 * مكون إضافة دورة جديدة | Create Course Component
 */
class Create extends Component
{
    public $title;
    public $description;
    public $price;
    public $status = 'draft';

    /**
     * التحقق من الصلاحية عند تحميل الصفحة | Check permission on mount
     */
    public function mount()
    {
        abort_unless(Gate::allows('manage courses'), 403);
    }

    /**
     * إضافة دورة جديدة | Store new course
     */
    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:draft,published,archived',
        ]);

        $course = Course::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'status' => $this->status,
            'instructor_id' => Auth::id(),
        ]);

        session()->flash('success', 'تمت إضافة الدورة بنجاح | Course added successfully');
        return redirect()->route('courses.index');
    }

    /**
     * عرض نموذج الإضافة | Render create form
     */
    public function render()
    {
        return view('livewire.courses.create');
    }
}
