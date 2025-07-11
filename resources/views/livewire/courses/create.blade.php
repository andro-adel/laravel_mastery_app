<div class="max-w-lg mx-auto">
    <h2 class="text-xl font-bold mb-4">إضافة دورة جديدة | Add New Course</h2>
    @if (session('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-2">{{ session('success') }}</div>
    @endif
    <form wire:submit.prevent="save">
        <div class="mb-2">
            <label>العنوان | Title</label>
            <input type="text" wire:model.defer="title" class="border rounded w-full px-2 py-1">
            @error('title') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
        <div class="mb-2">
            <label>الوصف | Description</label>
            <textarea wire:model.defer="description" class="border rounded w-full px-2 py-1"></textarea>
            @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
        <div class="mb-2">
            <label>السعر | Price</label>
            <input type="number" wire:model.defer="price" class="border rounded w-full px-2 py-1">
            @error('price') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
        <div class="mb-2">
            <label>الحالة | Status</label>
            <select wire:model.defer="status" class="border rounded w-full px-2 py-1">
                <option value="draft">مسودة | Draft</option>
                <option value="published">منشورة | Published</option>
                <option value="archived">مؤرشفة | Archived</option>
            </select>
            @error('status') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">حفظ | Save</button>
        <a href="{{ route('courses.index') }}" class="ml-2 text-gray-600">إلغاء | Cancel</a>
    </form>
</div>
