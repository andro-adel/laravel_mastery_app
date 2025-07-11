<div>
    <h1 class="text-2xl font-bold mb-4">تفاصيل المستخدم</h1>
    <div class="bg-white rounded shadow p-4">
        <div class="mb-2"><strong>الاسم:</strong> {{ $user->name }}</div>
        <div class="mb-2"><strong>البريد الإلكتروني:</strong> {{ $user->email }}</div>
        <div class="mb-2"><strong>تاريخ الإنشاء:</strong> {{ $user->created_at }}</div>
        <div class="mb-2"><strong>الدور:</strong> {{ implode(', ', $user->getRoleNames()->toArray()) }}</div>
    </div>
    <div class="mt-4">
        <a href="{{ route('users.index') }}" class="text-blue-600 hover:underline">&larr; العودة لقائمة المستخدمين</a>
    </div>
</div>
