<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('لوحة التحكم | Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded shadow text-center">
                    <div class="text-2xl font-bold">{{ \App\Models\User::count() }}</div>
                    <div class="text-gray-600 mt-2">المستخدمون | Users</div>
                </div>
                <div class="bg-white p-6 rounded shadow text-center">
                    <div class="text-2xl font-bold">{{ \App\Models\Course::count() }}</div>
                    <div class="text-gray-600 mt-2">الدورات | Courses</div>
                </div>
                <div class="bg-white p-6 rounded shadow text-center">
                    <div class="text-2xl font-bold">{{ \App\Models\Enrollment::count() }}</div>
                    <div class="text-gray-600 mt-2">التسجيلات | Enrollments</div>
                </div>
                <div class="bg-white p-6 rounded shadow text-center">
                    <div class="text-2xl font-bold">{{ \App\Models\Payment::count() }}</div>
                    <div class="text-gray-600 mt-2">المدفوعات | Payments</div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-8">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">آخر العمليات | Latest Activity</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <h4 class="font-semibold mb-2">أحدث الدورات | Latest Courses</h4>
                            <ul>
                                @foreach(\App\Models\Course::latest()->take(5)->get() as $course)
                                <li class="mb-1">{{ $course->title }} <span class="text-xs text-gray-500">({{
                                        $course->created_at->format('Y-m-d') }})</span></li>
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-2">أحدث التسجيلات | Latest Enrollments</h4>
                            <ul>
                                @foreach(\App\Models\Enrollment::latest()->take(5)->get() as $enrollment)
                                <li class="mb-1">{{ $enrollment->user->name ?? '-' }} - {{ $enrollment->course->title ??
                                    '-' }} <span class="text-xs text-gray-500">({{
                                        $enrollment->created_at->format('Y-m-d') }})</span></li>
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-2">أحدث المدفوعات | Latest Payments</h4>
                            <ul>
                                @foreach(\App\Models\Payment::latest()->take(5)->get() as $payment)
                                <li class="mb-1">{{ $payment->user->name ?? '-' }} - {{ $payment->amount }} <span
                                        class="text-xs text-gray-500">({{ $payment->paid_at ??
                                        $payment->created_at->format('Y-m-d') }})</span></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
