<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // إنشاء أدوار وصلاحيات
        $this->call(RolePermissionSeeder::class);

        // إنشاء مستخدمين
        \App\Models\User::factory(10)->create()->each(function ($user) {
            if ($user->id % 3 === 0) {
                $user->assignRole('admin');
            } elseif ($user->id % 2 === 0) {
                $user->assignRole('instructor');
            } else {
                $user->assignRole('student');
            }
        });

        // إنشاء دورات مع مدربين
        $instructors = \App\Models\User::role('instructor')->get();
        Course::factory(10)->make()->each(function ($course) use ($instructors) {
            $course->instructor_id = $instructors->random()->id;
            $course->save();
        });

        // إنشاء تسجيلات لطلاب في الدورات
        $students = \App\Models\User::role('student')->get();
        $courses = Course::all();
        foreach ($students as $student) {
            $enrolledCourses = $courses->random(rand(2, 5));
            foreach ($enrolledCourses as $course) {
                $enrollment = Enrollment::create([
                    'user_id' => $student->id,
                    'course_id' => $course->id,
                    'status' => 'active',
                ]);
                // إنشاء مدفوعات للتسجيل
                Payment::factory(rand(1,2))->create([
                    'user_id' => $student->id,
                    'enrollment_id' => $enrollment->id,
                ]);
            }
        }
    }
}
