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

require __DIR__.'/auth.php';
