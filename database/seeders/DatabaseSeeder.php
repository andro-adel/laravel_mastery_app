<?php
/**
 * Database Seeder
 *
 * English: Seeds the application's database with initial data. Used for populating tables with sample or default data.
 * Arabic: يعبئ قاعدة بيانات التطبيق ببيانات أولية. يُستخدم لملء الجداول ببيانات تجريبية أو افتراضية.
 */

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
