<div class="max-w-4xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6 text-center">لوحة تحكم المشرف | Admin Dashboard</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded shadow p-4 text-center">
            <div class="text-3xl font-bold text-blue-700">{{ $usersCount }}</div>
            <div class="text-gray-600 mt-2">المستخدمون | Users</div>
        </div>
        <div class="bg-white rounded shadow p-4 text-center">
            <div class="text-3xl font-bold text-green-700">{{ $coursesCount }}</div>
            <div class="text-gray-600 mt-2">الدورات | Courses</div>
        </div>
        <div class="bg-white rounded shadow p-4 text-center">
            <div class="text-3xl font-bold text-purple-700">{{ $enrollmentsCount }}</div>
            <div class="text-gray-600 mt-2">التسجيلات | Enrollments</div>
        </div>
        <div class="bg-white rounded shadow p-4 text-center">
            <div class="text-3xl font-bold text-yellow-700">${{ number_format($revenue, 2) }}</div>
            <div class="text-gray-600 mt-2">الإيرادات | Revenue</div>
        </div>
    </div>
    <div class="mt-8 text-center">
        <a href="/" class="text-blue-600">العودة للرئيسية | Back to Home</a>
    </div>
</div>
