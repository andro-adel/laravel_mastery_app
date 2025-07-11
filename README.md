# Laravel Mastery App

مرحبًا بك في مشروع "Laravel Mastery App" المرجعي الشامل لبناء منصة تعليمية متكاملة وحديثة باستخدام Laravel + Livewire + Volt + Vite فقط (بدون REST API منفصل).

Welcome to the "Laravel Mastery App" – a comprehensive reference project for building a modern, full-featured educational platform using Laravel, Livewire, Volt, and Vite (Monolithic, no separate REST API).

---

## فكرة المشروع | Project Idea

منصة تعليمية متكاملة لإدارة الدورات، المستخدمين، التسجيلات، والمدفوعات، مع دعم كامل للمصادقة، الأدوار، الإشعارات، لوحة تحكم متقدمة، واختبارات وتوثيق ثنائي اللغة.

A complete educational platform for managing courses, users, enrollments, and payments, with full support for authentication, roles, notifications, advanced admin dashboard, and bilingual tests & documentation.

---

## الجمهور المستهدف | Target Audience
- مطورو PHP/Laravel/Livewire الباحثون عن مرجع عملي حديث.
- أي شخص يريد تعلم بناء تطبيقات متقدمة باستخدام Laravel وLivewire وVolt وVite.

---

## الخصائص الأساسية | Core Features
- إدارة المستخدمين والأدوار (Users & Roles Management)
- إدارة الدورات والتسجيلات (Courses & Enrollments CRUD)
- مصادقة متقدمة (Auth, Socialite)
- نظام أدوار وصلاحيات مرن (RBAC)
- إشعارات وأحداث (Notifications, Events)
- لوحة تحكم متقدمة (Admin Dashboard)
- بحث وتصنيف وترتيب متقدم (Advanced Search/Filter/Sort)
- اختبارات شاملة (Feature & Unit Tests)
- توثيق وشرح ثنائي اللغة (Bilingual Docs)
- واجهات عصرية ودعم الوضع الليلي (Modern UI & Dark Mode)

---

## كيف تبدأ؟ | Getting Started

1. **تثبيت الحزم | Install dependencies**
   ```bash
   composer install
   npm install
   ```
2. **تشغيل السيرفر | Run the server**
   ```bash
   php artisan migrate:fresh --seed
   php artisan serve
   npm run dev
   ```

---

## مثال تعليمي سريع | Quick Educational Example

```php
// إضافة دورة جديدة عبر Livewire
Livewire.emit('courses.create', [
    'title' => 'Laravel Basics',
    'description' => 'Learn Laravel from scratch',
    'price' => 100,
    'status' => 'published',
]);
```

```blade
{{-- عرض رسالة نجاح في Blade --}}
<x-action-message on="course-added">
    {{ __('تمت إضافة الدورة بنجاح! | Course added successfully!') }}
</x-action-message>
```

---

## مساهمتك | Contributing

انظر ملف CONTRIBUTING.md لمزيد من التفاصيل.
See CONTRIBUTING.md for more details.
