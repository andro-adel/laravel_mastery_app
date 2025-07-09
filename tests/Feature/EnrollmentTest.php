<?php
/**
 * Enrollment Feature Test
 * English: Tests the enrollment process and payment status for a course.
 * Arabic: يختبر عملية التسجيل في الكورس وحالة الدفع.
 */

declare(strict_types=1);

use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->course = Course::factory()->create();
});

test('user can enroll in a course', function () {
    $this->actingAs($this->user);
    $enrollment = Enrollment::create([
        'user_id' => $this->user->id,
        'course_id' => $this->course->id,
        'payment_status' => 'pending',
    ]);
    expect($enrollment->user_id)->toBe($this->user->id)
        ->and($enrollment->course_id)->toBe($this->course->id)
        ->and($enrollment->payment_status)->toBe('pending');
});

test('user cannot enroll twice in the same course', function () {
    $this->actingAs($this->user);
    Enrollment::create([
        'user_id' => $this->user->id,
        'course_id' => $this->course->id,
        'payment_status' => 'pending',
    ]);
    $this->expectException(\Illuminate\Database\QueryException::class);
    Enrollment::create([
        'user_id' => $this->user->id,
        'course_id' => $this->course->id,
        'payment_status' => 'pending',
    ]);
});
