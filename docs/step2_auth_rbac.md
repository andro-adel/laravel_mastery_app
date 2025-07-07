# Step 2 – Authentication & Role-Based Access Control

## What Was Done

1. **Installed Laravel Breeze** for authentication scaffolding (Livewire stack with dark mode).
2. **Ran migrations** to set up authentication and default tables.
3. **Installed Spatie Laravel-Permission** for role and permission management.
4. **Published and migrated** Spatie's permission tables.
5. **Updated the User model** to use the `HasRoles` trait.
6. **Created a RoleSeeder** to seed default roles (`admin`, `user`).
7. **Updated DatabaseSeeder** to assign the `admin` role to the test user.
8. **Seeded the database** with roles and a test admin user.

## Why
- To provide secure authentication and flexible role-based access control for the application.
- To enable easy assignment and checking of user roles and permissions.

---

## بالعربي

1. **تثبيت Laravel Breeze** لتوليد صفحات تسجيل الدخول والتسجيل تلقائيًا (باستخدام Livewire ودعم الوضع الليلي).
2. **تشغيل الهجرات** لإنشاء جداول المستخدمين والجداول الافتراضية.
3. **تثبيت Spatie Laravel-Permission** لإدارة الأدوار والصلاحيات.
4. **نشر وتشغيل هجرات Spatie** لإنشاء جداول الأدوار والصلاحيات.
5. **تحديث نموذج المستخدم** لإضافة Trait الخاص بالأدوار.
6. **إنشاء RoleSeeder** لإضافة أدوار افتراضية (admin, user).
7. **تحديث DatabaseSeeder** لإسناد دور admin للمستخدم التجريبي.
8. **تعبئة قاعدة البيانات** بالأدوار ومستخدم admin تجريبي.

**الهدف:** توفير نظام مصادقة وصلاحيات مرن وآمن يسهل إدارته وتطويره.
