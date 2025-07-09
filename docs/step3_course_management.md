# Step 3: Course Management (الخطوة 3: إدارة الكورسات)

## What Was Done

1. **Implemented Course CRUD:**
   - Created Livewire Volt components for creating, editing, viewing, and deleting courses.
   - Added file upload for course images.
   - Applied validation and authorization for each action.
2. **Role-based Access:**
   - Only admins and instructors can create/edit/delete courses.
   - Instructors can only manage their own courses.
   - Students can only view published courses.
3. **UI Enhancements:**
   - Added bilingual (Arabic/English) labels and messages in forms and tables.
   - Displayed instructor name, status, and actions in the course list.
4. **Policy & Security:**
   - Used `CoursePolicy` for all course actions.
   - Protected routes with appropriate middleware.
5. **Testing:**
   - Added feature tests for all course management scenarios (admin, instructor, student).

## Why
- To provide a complete, secure, and user-friendly course management system.
- To ensure only authorized users can manage courses.

---

## بالعربي

1. **تطبيق إدارة الكورسات (CRUD):**
   - إنشاء مكونات Livewire Volt لإضافة وتعديل وعرض وحذف الكورسات.
   - دعم رفع صورة لكل كورس.
   - التحقق من صحة البيانات والصلاحيات لكل عملية.
2. **الصلاحيات حسب الدور:**
   - فقط المدير والمدرس يمكنهم إضافة/تعديل/حذف الكورسات.
   - المدرس يدير فقط كورساته.
   - الطالب يشاهد الكورسات المنشورة فقط.
3. **تحسين الواجهة:**
   - جميع النماذج والجداول ثنائية اللغة.
   - عرض اسم المدرس، الحالة، والإجراءات في قائمة الكورسات.
4. **السياسات والأمان:**
   - استخدام سياسة CoursePolicy لكل العمليات.
   - حماية المسارات بالوسطاء المناسبين.
5. **الاختبارات:**
   - إضافة اختبارات Feature لكل سيناريوهات إدارة الكورسات.

**الهدف:** توفير نظام إدارة كورسات متكامل وآمن وسهل الاستخدام لجميع الأدوار.
