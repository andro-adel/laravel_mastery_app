<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Seeder لإضافة الأدوار والصلاحيات الأساسية | Seeder for default roles and permissions
 */
class RolePermissionSeeder extends Seeder
{
    /**
     * تشغيل Seeder | Run the seeder
     */
    public function run(): void
    {
        // إنشاء الصلاحيات | Create permissions
        $permissions = [
            'manage courses', // إدارة الدورات
            'enroll courses', // التسجيل في الدورات
            'manage users',   // إدارة المستخدمين
            'view dashboard', // عرض لوحة التحكم
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // إنشاء الأدوار وربط الصلاحيات | Create roles and assign permissions
        $student = Role::firstOrCreate(['name' => 'student']);
        $student->givePermissionTo(['enroll courses']);

        $instructor = Role::firstOrCreate(['name' => 'instructor']);
        $instructor->givePermissionTo(['manage courses']);

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo($permissions);
    }
}
