# Project Folder Structure (خريطة المشروع)

This document describes the main folders and files in this Laravel project and their purposes.

---

## Root Files
- **artisan**: Laravel CLI tool for running commands.
- **composer.json / composer.lock**: PHP dependencies and versions.
- **package.json**: Node.js dependencies for frontend assets.
- **phpunit.xml**: PHPUnit configuration for testing.
- **README.md**: Project overview and instructions.
- **vite.config.js**: Vite configuration for asset bundling.

## Main Folders
- **app/**: Application core code (controllers, models, providers).
  - **Http/Controllers/**: Handles HTTP requests and responses.
  - **Models/**: Eloquent models representing database tables.
  - **Providers/**: Service providers for bootstrapping services.
- **bootstrap/**: Bootstraps the framework and loads configuration.
- **config/**: Application configuration files (auth, database, cache, etc).
- **database/**: Database migrations, seeders, and factories.
  - **migrations/**: Database schema definitions.
  - **seeders/**: Classes for populating the database with data.
  - **factories/**: Factories for generating test data.
- **public/**: Web server root. Contains `index.php` and public assets.
- **resources/**: Views, raw assets (CSS, JS), and language files.
  - **views/**: Blade templates for HTML rendering.
  - **css/**, **js/**: Frontend assets.
- **routes/**: Route definitions for web and console (CLI) requests.
- **storage/**: Compiled views, logs, cache, and user files.
- **tests/**: Unit and feature tests.
- **vendor/**: Composer-managed PHP dependencies (auto-generated).

---

## بالعربي

- **app/**: كود التطبيق الأساسي (التحكم، النماذج، المزودات).
- **bootstrap/**: تهيئة الإطار وتحميل الإعدادات.
- **config/**: ملفات إعدادات التطبيق.
- **database/**: الهجرات، تعبئة البيانات، المصانع.
- **public/**: جذر السيرفر وملفات عامة.
- **resources/**: القوالب والملفات الأمامية.
- **routes/**: تعريف المسارات.
- **storage/**: ملفات مؤقتة، سجلات، ملفات المستخدمين.
- **tests/**: اختبارات التطبيق.
- **vendor/**: مكتبات PHP الخارجية.

---

## Code Flow Diagram | مخطط تدفق الكود

```mermaid
graph TD;
  A[Route] --> B[Controller]
  B --> C[Model]
  B --> D[View (Blade)]
  C -->|Data| D
```

**English:**
- The request starts at the Route, goes to the Controller, which may interact with the Model (database), and finally returns a View to the user.

**بالعربي:**
- يبدأ الطلب من المسار (Route)، ثم يذهب إلى وحدة التحكم (Controller)، والتي قد تتعامل مع النموذج (Model) لجلب البيانات، وأخيرًا تعرض النتيجة في الواجهة (View).

---
