<?php

use Livewire\Volt\Component;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public Course $course;
    public $title;
    public $description;
    public $image;
    public $status;
    public $currentImage;

    public function mount(Course $course)
    {
        $this->authorize('update', $course);
        // Initialize properties from the course | تهيئة الخصائص من بيانات الدورة
        $this->course = $course;
        $this->title = $course->title;
        $this->description = $course->description;
        $this->status = $course->status;
        $this->currentImage = $course->image_path;
    }

    /**
     * Update the course in the database.
     * تحديث بيانات الدورة في قاعدة البيانات
     */
    public function update()
    {
        $this->validate([
            'title' => 'required|string|max:255', // Course title | عنوان الدورة
            'description' => 'required|string', // Course description | وصف الدورة
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Featured image | صورة الدورة
            'status' => 'required|in:draft,published', // Course status | حالة الدورة
        ]);

        $imagePath = $this->currentImage;
        if ($this->image) {
            // Delete old image if exists | حذف الصورة القديمة إذا وجدت
            if ($this->currentImage && \Storage::disk('public')->exists($this->currentImage)) {
                \Storage::disk('public')->delete($this->currentImage);
            }
            // Store new image | حفظ الصورة الجديدة
            $imagePath = $this->image->store('courses', 'public');
        }

        $this->course->update([
            'title' => $this->title,
            'description' => $this->description,
            'image_path' => $imagePath,
            'status' => $this->status,
        ]);

        session()->flash('success', __('Course updated successfully! | تم تحديث الدورة بنجاح!'));
        return redirect()->route('courses.index');
    }
}; ?>

<div>
    <!-- Edit Course Form | نموذج تعديل دورة -->
    <h2 class="text-2xl font-bold mb-4">Edit Course | تعديل دورة</h2>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="update" enctype="multipart/form-data" class="space-y-4">
        <div>
            <label>Title | العنوان</label>
            <input type="text" wire:model.defer="title" class="form-input w-full" required />
            @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Description | الوصف</label>
            <textarea wire:model.defer="description" class="form-textarea w-full" required></textarea>
            @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Current Image | الصورة الحالية</label>
            @if ($currentImage)
            <img src="{{ asset('storage/' . $currentImage) }}" alt="Course Image" class="h-24 mb-2">
            @else
            <span>No image | لا توجد صورة</span>
            @endif
        </div>
        <div>
            <label>New Image | صورة جديدة</label>
            <input type="file" wire:model="image" class="form-input w-full" />
            @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Status | الحالة</label>
            <select wire:model.defer="status" class="form-select w-full">
                <option value="draft">Draft | مسودة</option>
                <option value="published">Published | منشورة</option>
            </select>
            @error('status') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update | تحديث</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel | إلغاء</a>
    </form>
</div>
