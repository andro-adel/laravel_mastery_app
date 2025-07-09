# Step 4: Enrollment, Payments, Notifications, Queues (Laravel 12)

## What Was Done | ماذا تم؟

**English:**
- Installed and configured Laravel Cashier (Stripe) for payments and subscriptions.
- Published and migrated Cashier's database tables.
- Added `enrollments` table to link users and courses with payment status.
- Created `Enrollment` model and relationships in `User` and `Course` models.
- Added feature tests for enrollment logic (unique, creation).
- Implemented notifications for enrollment payment status.
- Configured queued jobs for sending notifications.

**بالعربي:**
- تم تثبيت Laravel Cashier (Stripe) لإدارة المدفوعات والاشتراكات.
- تم نشر وتشغيل هجرات Cashier الخاصة بقاعدة البيانات.
- تم إضافة جدول `enrollments` لربط المستخدمين بالكورسات مع حالة الدفع.
- إنشاء نموذج Enrollment وربطه بنماذج المستخدم والكورس.
- إضافة اختبارات Feature لمنطق التسجيل (الفريد، الإنشاء).
- تنفيذ إشعارات لحالة دفع التسجيل.
- تكوين مهام الطوابير لإرسال الإشعارات.

---

## Enrollment Table | جدول التسجيلات

**English:**
- Added `enrollments` table to link users and courses with payment status.
- Created `Enrollment` model and relationships in `User` and `Course` models.
- Added feature tests for enrollment logic (unique, creation).

**بالعربي:**
- تم إضافة جدول `enrollments` لربط المستخدمين بالكورسات مع حالة الدفع.
- إنشاء نموذج Enrollment وربطه بنماذج المستخدم والكورس.
- إضافة اختبارات Feature لمنطق التسجيل (الفريد، الإنشاء).

---

## Stripe Integration | التكامل مع Stripe

**English:**
- Added `Billable` trait to the `User` model to enable Stripe payments and subscriptions via Laravel Cashier.
- User can now be charged, subscribe, and manage payment methods.

**بالعربي:**
- تم إضافة Trait Billable إلى نموذج User لدعم عمليات الدفع والاشتراكات عبر Stripe باستخدام Cashier.
- يمكن الآن للمستخدم الدفع والاشتراك وإدارة طرق الدفع.

---

## Payment Workflow | سير عمل الدفع

**English:**
- Added `EnrollmentController` to handle course enrollment and payment via Stripe (Cashier).
- Uses Stripe PaymentIntent for secure, SCA-compliant payments.
- Enrollment is created as `pending` until payment is confirmed.
- Returns `client_secret` to frontend for payment confirmation.

**بالعربي:**
- إضافة EnrollmentController للتحكم في عملية التسجيل والدفع عبر Stripe (Cashier).
- استخدام PaymentIntent من Stripe لضمان الأمان والتوافق مع SCA.
- يتم إنشاء التسجيل كـ pending حتى يتم تأكيد الدفع.
- إرجاع client_secret للواجهة الأمامية لتأكيد الدفع.

---

## Notifications & Queues | الإشعارات والطوابير

**English:**
- Added `EnrollmentPaid` and `EnrollmentFailed` notifications (mail + database) for enrollment payment status.
- Notifications are queued for background delivery (ShouldQueue).
- Controller sends notification to user on payment success or failure.

**بالعربي:**
- إضافة إشعارات عند نجاح أو فشل دفع التسجيل (بريد + قاعدة بيانات).
- الإشعارات تعمل في الخلفية باستخدام الطوابير (ShouldQueue).
- الكنترولر يرسل الإشعار للمستخدم عند نجاح أو فشل الدفع.

---

## Commands Used | الأوامر المستخدمة

```bash
composer require laravel/cashier
php artisan vendor:publish --tag="cashier-migrations"
php artisan migrate
php artisan make:migration create_enrollments_table
php artisan migrate
php artisan make:model Enrollment
php artisan test --filter=EnrollmentTest
php artisan make:controller EnrollmentController
php artisan make:notification EnrollmentPaid
php artisan make:notification EnrollmentFailed
```

---

## Next Steps | الخطوات التالية
- Integrate enrollment logic and payment workflow.
- Add notifications and queue jobs.
- Document and test all features.

---

**Continue to next steps as described in the plan.**
