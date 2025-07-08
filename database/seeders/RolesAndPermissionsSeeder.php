<?php
/**
 * RolesAndPermissionsSeeder
 *
 * English: Seeds roles and permissions, assigns permissions to roles, and creates a default admin user.
 * Arabic: يعبئ قاعدة البيانات بالأدوار والصلاحيات، ويربط الصلاحيات بالأدوار، وينشئ مستخدم مدير افتراضي.
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Define permissions
        $permissions = [
            'manage-courses',
            'view-courses',
            'enroll-courses',
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Define roles
        $roles = [
            'admin' => ['manage-courses', 'view-courses', 'enroll-courses'],
            'instructor' => ['manage-courses', 'view-courses'],
            'student' => ['view-courses', 'enroll-courses'],
        ];
        foreach ($roles as $role => $perms) {
            $roleObj = Role::firstOrCreate(['name' => $role]);
            $roleObj->syncPermissions($perms);
        }

        // Create default admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole('admin');
    }
}
