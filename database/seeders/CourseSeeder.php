<?php
/**
 * Course Seeder
 *
 * English: Seeds the database with sample courses for testing and development.
 * Arabic: يعبئ قاعدة البيانات بكورسات تجريبية للاختبار والتطوير.
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        // Create sample users for instructors
        $instructor1 = \App\Models\User::factory()->create(['name' => 'Ahmed Ali', 'email' => 'ahmed@example.com']);
        $instructor2 = \App\Models\User::factory()->create(['name' => 'Sara Mohamed', 'email' => 'sara@example.com']);

        DB::table('courses')->insert([
            [
                'title' => 'Laravel Basics',
                'description' => 'Introduction to Laravel framework.',
                'image_path' => null,
                'instructor_id' => $instructor1->id,
                'status' => 'published',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'PHP Advanced',
                'description' => 'Deep dive into advanced PHP topics.',
                'image_path' => null,
                'instructor_id' => $instructor2->id,
                'status' => 'draft',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
