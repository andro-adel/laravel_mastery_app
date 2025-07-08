<?php
/**
 * Course CRUD Feature Test
 *
 * English: Tests the full CRUD operations for courses (create, read, update, delete) with role-based access.
 * Arabic: يختبر جميع عمليات الدورات (إضافة، عرض، تعديل، حذف) مع التحقق من الصلاحيات.
 */

declare(strict_types=1);

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Livewire\Volt\Volt;
use Livewire\Livewire;

beforeEach(function () {
    // Ensure roles exist for tests
    foreach (['admin', 'instructor', 'student'] as $role) {
        if (!\Spatie\Permission\Models\Role::where('name', $role)->exists()) {
            \Spatie\Permission\Models\Role::create(['name' => $role]);
        }
    }
    \Illuminate\Support\Facades\Storage::fake('public');
});

test('admin can create, view, update, and delete a course', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');
    $this->actingAs($admin);

    // Use constants for repeated values
    $courseTitle = 'Test Course';
    $updatedTitle = 'Updated Title';

    // Create
    $component = Volt::test('courses.create')
        ->set('title', $courseTitle)
        ->set('description', 'Test Description')
        ->set('status', 'published')
        ->call('save');
    $component->assertRedirect(route('courses.index', absolute: false));
    $this->assertDatabaseHas('courses', ['title' => $courseTitle]);

    $course = Course::where('title', $courseTitle)->first();

    // View
    $response = $this->get(route('courses.show', $course));
    $response->assertOk()->assertSee($courseTitle);

    // Update
    $component = Volt::test('courses.edit', ['course' => $course])
        ->set('title', $updatedTitle)
        ->set('description', 'Updated Description')
        ->set('status', 'draft')
        ->call('update');
    $component->assertRedirect(route('courses.index', absolute: false));
    $this->assertDatabaseHas('courses', ['title' => $updatedTitle]);

    // Delete
    Volt::test('courses.index')->call('delete', $course->id);
    $this->assertDatabaseMissing('courses', ['id' => $course->id]);
});

test('instructor can only manage their own courses', function () {
    $instructor = User::factory()->create();
    $instructor->assignRole('instructor');
    $this->actingAs($instructor);

    $other = User::factory()->create();
    $other->assignRole('instructor');
    $course = Course::factory()->create(['instructor_id' => $other->id]);

    // Instructor cannot edit/delete other's course
    $component = Volt::test('courses.edit', ['course' => $course]);
    $component->assertForbidden();
    Volt::test('courses.index')->call('delete', $course->id);
    $this->assertDatabaseHas('courses', ['id' => $course->id]);
});

test('student can only view published courses', function () {
    $student = User::factory()->create();
    $student->assignRole('student');
    $this->assertTrue($student->hasRole('student'));
    $this->actingAs($student);

    $published = Course::factory()->create([
        'status' => 'published',
        'title' => 'Unique Published Title',
    ]);
    $draft = Course::factory()->create([
        'status' => 'draft',
        'title' => 'Unique Draft Title',
    ]);

    Livewire::test('courses.index')
        ->assertSee($published->title)
        ->assertDontSee($draft->title);
});
