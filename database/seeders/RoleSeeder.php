<?php
/**
 * Role Seeder
 *
 * English: Seeds the database with default roles using Spatie Laravel-Permission.
 * Arabic: يعبئ قاعدة البيانات بالأدوار الافتراضية باستخدام Spatie Laravel-Permission.
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create default roles
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'user']);
    }
}
