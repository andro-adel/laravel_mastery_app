<div>
    <h1 class="text-2xl font-bold mb-4">إضافة مستخدم جديد</h1>
    <form wire:submit.prevent="save" class="bg-white rounded shadow p-4 max-w-lg mx-auto">
        <div class="mb-2">
            <label class="block mb-1">الاسم</label>
            <input type="text" wire:model="name" class="border rounded px-2 py-1 w-full" />
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-2">
            <label class="block mb-1">البريد الإلكتروني</label>
            <input type="email" wire:model="email" class="border rounded px-2 py-1 w-full" />
            @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-2">
            <label class="block mb-1">كلمة المرور</label>
            <input type="password" wire:model="password" class="border rounded px-2 py-1 w-full" />
            @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-2">
            <label class="block mb-1">الدور</label>
            <select wire:model="role" class="border rounded px-2 py-1 w-full">
                <option value="">اختر الدور</option>
                @foreach($roles as $role)
                <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
            @error('role') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4 flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">حفظ</button>
            <a href="{{ route('users.index') }}" class="text-gray-600 hover:underline">إلغاء</a>
        </div>
    </form>
</div>
