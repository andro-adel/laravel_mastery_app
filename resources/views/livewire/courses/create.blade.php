<?php

use Livewire\Volt\Component;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    // Course properties | خصائص الدورة
    public $title;
    public $description;
    public $image;
    public $status = 'draft';

    /**
     * Store a new course in the database.
     * حفظ دورة جديدة في قاعدة البيانات
     */
    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255', // Course title | عنوان الدورة
            'description' => 'required|string', // Course description | وصف الدورة
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Featured image | صورة الدورة
            'status' => 'required|in:draft,published', // Course status | حالة الدورة
        ]);

        $imagePath = null;
        if ($this->image) {
            // Store image in storage/app/public/courses | حفظ الصورة في مجلد الدورات
            $imagePath = $this->image->store('courses', 'public');
        }

        Course::create([
            'title' => $this->title,
            'description' => $this->description,
            'image_path' => $imagePath,
            'instructor_id' => Auth::id(),
            'status' => $this->status,
        ]);

        session()->flash('success', __('Course created successfully! | تم إنشاء الدورة بنجاح!'));
        return redirect()->route('courses.index');
    }
}; ?>

<div>
    <!-- Add Course Form | نموذج إضافة دورة -->
    <h2 class="text-2xl font-bold mb-4">Add Course | إضافة دورة</h2>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="save" enctype="multipart/form-data" class="space-y-4">
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
            <label>Featured Image | صورة الدورة</label>
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
        <button type="submit" class="btn btn-primary">Save | حفظ</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel | إلغاء</a>
    </form>
</div>
