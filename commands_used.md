# قائمة أوامر Laravel المستخدمة في المشروع

## 1. إنشاء مشروع Laravel جديد
```
composer create-project laravel/laravel laravel_mastery_app
```

## 2. إعداد قاعدة البيانات
- تعديل ملف `.env` بمعلومات الاتصال بقاعدة البيانات.

## 3. إنشاء نموذج المستخدم (User) وجداول أساسية
```
php artisan migrate
```

## 4. إنشاء نموذج ودوال المصادقة (Auth)
```
php artisan make:auth   # (في الإصدارات القديمة)
# أو
composer require laravel/breeze --dev
php artisan breeze:install
npm install && npm run dev
php artisan migrate
```

## 5. إنشاء Livewire
```
composer require livewire/livewire
php artisan livewire:publish --assets
```

## 6. إنشاء مكونات Livewire
```
php artisan make:livewire Courses/ExampleComponent
```

## 6. إنشاء مكونات Livewire Volt لإدارة الدورات (CRUD)
```
php artisan make:livewire courses.index --volt
php artisan make:livewire courses.create --volt
php artisan make:livewire courses.edit --volt
php artisan make:livewire courses.show --volt
```
- هذه الأوامر تنشئ مكونات Livewire Volt لعرض، إضافة، تعديل، وعرض تفاصيل الدورات.

## 7. إنشاء Policy للتحكم في صلاحيات الدورات
```
php artisan make:policy CoursePolicy --model=Course
```
- هذا الأمر ينشئ Policy للتحكم في من يمكنه إدارة الدورات (مدير، مدرس، طالب).

## 8. إنشاء Form Request للتحقق من صحة البيانات
```
php artisan make:request StoreCourseRequest
php artisan make:request UpdateCourseRequest
```
- هذه الأوامر تنشئ كلاس مخصص للتحقق من صحة البيانات عند إضافة أو تعديل دورة.

## 7. إنشاء ملفات الهجرة (Migrations) للدورات والصلاحيات
```
php artisan make:migration create_courses_table
php artisan make:migration create_permission_tables
```

## 8. إنشاء Seeder وتعبئة البيانات
```
php artisan make:seeder CourseSeeder
php artisan make:seeder RolesAndPermissionsSeeder
php artisan db:seed
```

## 9. إنشاء Factories
```
php artisan make:factory UserFactory --model=User
```

## 10. إنشاء Controllers
```
php artisan make:controller Auth/VerifyEmailController
php artisan make:controller Controller
```

## 11. إنشاء Providers
```
php artisan make:provider VoltServiceProvider
```

## 12. تشغيل السيرفر المحلي
```
php artisan serve
```

## 13. أوامر أخرى
- تثبيت الحزم الأمامية:
```
npm install
npm run dev
```
- بناء المشروع للإنتاج:
```
npm run build
```

## 5. تثبيت مكتبة Spatie لإدارة الصلاحيات والأدوار (Roles & Permissions)
```
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate
```
- هذه المكتبة تُستخدم لإضافة نظام RBAC (roles & permissions) في Laravel، وتم استخدامها في seeders وملفات الهجرة.

---

> **ملاحظة:** هذه الأوامر مرتبة حسب مراحل التطوير المعتادة في مشروع Laravel مشابه لهذا المشروع، وقد تختلف بعض التفاصيل حسب التعديلات أو الإضافات الخاصة بالمطور.
