<div>
    <h1 class="text-2xl font-bold mb-4">قائمة المستخدمين</h1>
    <div class="mb-4 flex items-center gap-2">
        <input type="text" wire:model.debounce.500ms="search" placeholder="بحث بالاسم أو البريد..."
            class="border rounded px-2 py-1" />
        <a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">إضافة مستخدم</a>
    </div>
    @if (session()->has('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif
    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="cursor-pointer" wire:click="sortBy('id')">#</th>
                <th class="cursor-pointer" wire:click="sortBy('name')">الاسم</th>
                <th class="cursor-pointer" wire:click="sortBy('email')">البريد الإلكتروني</th>
                <th class="cursor-pointer" wire:click="sortBy('created_at')">تاريخ الإنشاء</th>
                <th>إجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td>
                    <a href="{{ route('users.show', $user) }}" class="text-blue-600 hover:underline">عرض</a>
                    <a href="{{ route('users.edit', $user) }}" class="text-green-600 hover:underline">تعديل</a>
                    <a href="#" wire:click.prevent="confirmDelete({{ $user->id }})"
                        class="text-red-600 hover:underline">حذف</a>
                    @if($confirmingDeleteId === $user->id)
                    <span class="ml-2 text-sm text-gray-700">هل أنت متأكد؟
                        <button wire:click.prevent="delete({{ $user->id }})"
                            class="bg-red-600 text-white px-2 py-1 rounded ml-1">تأكيد</button>
                        <button wire:click.prevent="$set('confirmingDeleteId', null)"
                            class="bg-gray-300 px-2 py-1 rounded">إلغاء</button>
                    </span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">لا يوجد مستخدمون</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
