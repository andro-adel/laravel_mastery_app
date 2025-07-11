<?php

namespace App\Livewire\Courses;

use Livewire\Component;
use App\Models\Course;
use Illuminate\Support\Facades\Gate;

/**
 * مكون تعديل دورة | Edit Course Component
 */
class Edit extends Component
{
    public Course $course;
    public $title;
    public $description;
    public $price;
    public $status;

    /**
     * تحميل بيانات الدورة والتحقق من الصلاحية | Mount and check permission
     */
    public function mount(Course $course)
    {
        abort_unless(Gate::allows('manage courses'), 403);
        $this->course = $course;
        $this->title = $course->title;
        $this->description = $course->description;
        $this->price = $course->price;
        $this->status = $course->status;
    }

    /**
     * حفظ التعديلات | Save changes
     */
    public function update()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:draft,published,archived',
        ]);

        $this->course->update([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'status' => $this->status,
        ]);

        session()->flash('success', 'تم تحديث الدورة بنجاح | Course updated successfully');
        return redirect()->route('courses.index');
    }

    /**
     * عرض نموذج التعديل | Render edit form
     */
    public function render()
    {
        return view('livewire.courses.edit');
    }
}
