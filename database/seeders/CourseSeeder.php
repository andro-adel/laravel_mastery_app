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
        DB::table('courses')->insert([
            [
                'name' => 'Laravel Basics',
                'description' => 'Introduction to Laravel framework.',
                'instructor' => 'Ahmed Ali',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'PHP Advanced',
                'description' => 'Deep dive into advanced PHP topics.',
                'instructor' => 'Sara Mohamed',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
