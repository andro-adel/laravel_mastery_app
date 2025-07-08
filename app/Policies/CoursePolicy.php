<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CoursePolicy
{
    /**
     * Determine whether the user can view any models.
     * تحديد ما إذا كان المستخدم يمكنه عرض أي دورة
     */
    public function viewAny(User $user): bool
    {
        // Allow all authenticated users to view courses | السماح لجميع المستخدمين بعرض الدورات
        return $user->hasRole(['admin', 'instructor', 'student']);
    }

    /**
     * Determine whether the user can view the model.
     * تحديد ما إذا كان المستخدم يمكنه عرض دورة معينة
     */
    public function view(User $user, Course $course): bool
    {
        // Allow all authenticated users to view a course | السماح لجميع المستخدمين بعرض دورة
        return $user->hasRole(['admin', 'instructor', 'student']);
    }

    /**
     * Determine whether the user can create models.
     * تحديد ما إذا كان المستخدم يمكنه إنشاء دورة
     */
    public function create(User $user): bool
    {
        // Only admin and instructor can create | فقط المدير والمدرس يمكنهم الإنشاء
        return $user->hasRole(['admin', 'instructor']);
    }

    /**
     * Determine whether the user can update the model.
     * تحديد ما إذا كان المستخدم يمكنه تعديل دورة
     */
    public function update(User $user, Course $course): bool
    {
        // Only admin or the instructor who owns the course can update | فقط المدير أو المدرس صاحب الدورة يمكنهم التعديل
        return $user->hasRole('admin') || ($user->hasRole('instructor') && $user->id === $course->instructor_id);
    }

    /**
     * Determine whether the user can delete the model.
     * تحديد ما إذا كان المستخدم يمكنه حذف دورة
     */
    public function delete(User $user, Course $course): bool
    {
        // Only admin or the instructor who owns the course can delete | فقط المدير أو المدرس صاحب الدورة يمكنهم الحذف
        return $user->hasRole('admin') || ($user->hasRole('instructor') && $user->id === $course->instructor_id);
    }

    /**
     * Determine whether the user can restore the model.
     * تحديد ما إذا كان المستخدم يمكنه استعادة دورة
     */
    public function restore(User $user, Course $course): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     * تحديد ما إذا كان المستخدم يمكنه حذف دورة نهائياً
     */
    public function forceDelete(User $user, Course $course): bool
    {
        return $user->hasRole('admin');
    }
}
