<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Laravel Mastery App – Course Booking System

## Project Overview | نظرة عامة على المشروع

**English:**
This project is a Laravel-based web application for booking courses. It features authentication, role-based access control (RBAC), and a clean, bilingual codebase (Arabic/English) to help any developer understand and extend the system easily.

**بالعربي:**
هذا المشروع هو تطبيق ويب مبني على لارافيل لحجز الكورسات. يحتوي على نظام تسجيل دخول وصلاحيات (RBAC)، والكود موثق ومنظم باللغتين العربية والإنجليزية ليسهل على أي مطور فهمه وتطويره.

---

## Features | المميزات
- User authentication (تسجيل دخول المستخدمين)
- Role & permission management (إدارة الأدوار والصلاحيات)
- Admin dashboard (لوحة تحكم المدير)
- Course management (إدارة الكورسات) – *to be implemented*
- Bilingual documentation (توثيق ثنائي اللغة)

---

## Project Structure | هيكل المشروع

See [`docs/project_map.md`](docs/project_map.md) for a detailed map.

**English:**
- `app/`: Application logic (controllers, models, providers)
- `routes/`: Route definitions
- `resources/views/`: Blade templates (UI)
- `database/`: Migrations, seeders, factories
- `config/`: Configuration files
- `public/`: Entry point and public assets
- `tests/`: Unit and feature tests

**بالعربي:**
- `app/`: منطق التطبيق (تحكم، نماذج، مزودات)
- `routes/`: تعريف المسارات
- `resources/views/`: قوالب العرض (واجهة المستخدم)
- `database/`: الهجرات، تعبئة البيانات، المصانع
- `config/`: ملفات الإعدادات
- `public/`: نقطة الدخول وملفات عامة
- `tests/`: اختبارات التطبيق

---

## How the Code is Connected | كيف الكود مربوط ببعضه

**English:**
- Routes direct requests to controllers or views.
- Controllers handle logic and interact with models.
- Models represent database tables and relationships.
- Views display data to users.
- Middleware (like `role:admin`) protects routes.
- Seeders populate roles, permissions, and users.

**بالعربي:**
- المسارات توجه الطلبات إلى وحدات التحكم أو الواجهات.
- وحدات التحكم تنفذ المنطق وتتفاعل مع النماذج.
- النماذج تمثل جداول قاعدة البيانات والعلاقات.
- القوالب تعرض البيانات للمستخدم.
- الوسطاء (مثل `role:admin`) يحمون المسارات.
- Seeders تملأ قاعدة البيانات بالأدوار والصلاحيات والمستخدمين.

---

## Setup & Usage | خطوات التشغيل

**English:**
1. Clone the repo and run `composer install` & `npm install`.
2. Copy `.env.example` to `.env` and set your DB credentials.
3. Run `php artisan migrate --seed` to set up tables and seed roles/users.
4. Run `npm run dev` to build assets.
5. Start the server: `php artisan serve`.

**بالعربي:**
1. انسخ المشروع وشغل `composer install` و`npm install`.
2. انسخ ملف `.env.example` إلى `.env` وعدل بيانات قاعدة البيانات.
3. شغل `php artisan migrate --seed` لإنشاء الجداول وتعبئة البيانات.
4. شغل `npm run dev` لبناء ملفات الواجهة.
5. شغل السيرفر: `php artisan serve`.

---

## Documentation | التوثيق
- [Project Map | خريطة المشروع](docs/project_map.md)
- [Step 1: Setup | الخطوة 1: الإعداد](docs/step1_setup.md)
- [Step 2: Auth & RBAC | الخطوة 2: التوثيق والصلاحيات](docs/step2_auth_rbac.md)

---

## Contribution & License | المساهمة والترخيص
- See [LICENSE](LICENSE) for details.
- للمساهمة أو الاستفسار راجع التوثيق أو تواصل مع مدير المشروع.
