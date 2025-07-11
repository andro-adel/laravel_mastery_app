<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

// مسارات إدارة الدورات | Courses Management Routes
use App\Livewire\Courses\Index as CoursesIndex;
use App\Livewire\Courses\Create as CoursesCreate;
use App\Livewire\Courses\Edit as CoursesEdit;
use App\Livewire\Courses\Show as CoursesShow;

Route::middleware(['auth'])->group(function () {
    Route::get('/courses', CoursesIndex::class)->name('courses.index'); // قائمة الدورات | Courses list
    Route::get('/courses/create', CoursesCreate::class)->name('courses.create'); // إضافة دورة | Create course
    Route::get('/courses/{course}/edit', CoursesEdit::class)->name('courses.edit'); // تعديل دورة | Edit course
    Route::get('/courses/{course}', CoursesShow::class)->name('courses.show'); // عرض تفاصيل دورة | Show course
});

// مسارات إدارة التسجيلات | Enrollments Management Routes
use App\Livewire\Enrollments\Index as EnrollmentsIndex;
use App\Livewire\Enrollments\Create as EnrollmentsCreate;
use App\Livewire\Enrollments\Edit as EnrollmentsEdit;
use App\Livewire\Enrollments\Show as EnrollmentsShow;

Route::middleware(['auth'])->group(function () {
    Route::get('/enrollments', EnrollmentsIndex::class)->name('enrollments.index'); // قائمة التسجيلات | Enrollments list
    Route::get('/enrollments/create', EnrollmentsCreate::class)->name('enrollments.create'); // إضافة تسجيل | Create enrollment
    Route::get('/enrollments/{enrollment}/edit', EnrollmentsEdit::class)->name('enrollments.edit'); // تعديل تسجيل | Edit enrollment
    Route::get('/enrollments/{enrollment}', EnrollmentsShow::class)->name('enrollments.show'); // عرض تفاصيل تسجيل | Show enrollment
});

use App\Livewire\Payments\Index as PaymentsIndex;
use App\Livewire\Payments\Show as PaymentsShow;
use App\Livewire\Payments\Create as PaymentsCreate;
use App\Livewire\Payments\Edit as PaymentsEdit;

Route::middleware(['auth'])->group(function () {
    Route::get('/payments', PaymentsIndex::class)->name('payments.index'); // قائمة المدفوعات
    Route::get('/payments/{payment}', PaymentsShow::class)->name('payments.show'); // تفاصيل المدفوعات
    Route::get('/payments/create', PaymentsCreate::class)->name('payments.create'); // إضافة مدفوعات
    Route::get('/payments/{payment}/edit', PaymentsEdit::class)->name('payments.edit'); // تعديل مدفوعات
});

use App\Livewire\Users\Index as UsersIndex;
use App\Livewire\Users\Show as UsersShow;
use App\Livewire\Users\Create as UsersCreate;
use App\Livewire\Users\Edit as UsersEdit;

Route::middleware(['auth'])->group(function () {
    Route::get('/users', UsersIndex::class)->name('users.index'); // قائمة المستخدمين
    Route::get('/users/{user}', UsersShow::class)->name('users.show'); // تفاصيل المستخدم
    Route::get('/users/create', UsersCreate::class)->name('users.create'); // إضافة مستخدم
    Route::get('/users/{user}/edit', UsersEdit::class)->name('users.edit'); // تعديل مستخدم
});

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/settings/profile', function () {
        return view('livewire.settings.profile');
    })->name('settings.profile');
    Route::get('/settings/password', function () {
        return view('livewire.settings.password');
    })->name('settings.password');
    Route::get('/settings/appearance', function () {
        return view('livewire.settings.appearance');
    })->name('settings.appearance');
});
