<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Admin dashboard route with role middleware
// English: Only users with the 'admin' role can access this route
// Arabic: فقط المستخدمين الذين لديهم دور 'admin' يمكنهم الوصول إلى هذا المسار
Route::middleware(['auth', 'role:admin'])
    ->get('/dashboard/admin', function () {
        return view('admin.dashboard');
    });

// Course CRUD routes | مسارات إدارة الدورات
use Livewire\Volt\Volt;

Route::middleware(['auth'])->group(function () {
    // List all courses | عرض جميع الدورات
    Volt::route('courses', 'courses.index')->name('courses.index');
    // Create a new course | إضافة دورة جديدة
    Volt::route('courses/create', 'courses.create')->name('courses.create');
    // Edit a course | تعديل دورة
    Volt::route('courses/{course}/edit', 'courses.edit')->name('courses.edit');
    // Show course details | عرض تفاصيل دورة
    Volt::route('courses/{course}', 'courses.show')->name('courses.show');
});

require __DIR__.'/auth.php';
