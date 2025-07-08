<?php
/**
 * Bootstrap Application
 *
 * English: Creates the application instance and binds important interfaces. This file is the entry point for bootstrapping the Laravel framework.
 * Arabic: ينشئ مثيل التطبيق ويربط الواجهات الهامة. هذا الملف هو نقطة البداية لتهيئة إطار عمل لارافيل.
 */

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    // Register middleware aliases for roles and permissions
    // English: Adds 'role' and 'permission' middleware aliases for Spatie Laravel-Permission
    // Arabic: يضيف أسماء مستعارة للوسيط 'role' و 'permission' الخاصة بحزمة Spatie Laravel-Permission
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            // English: Checks if the user has a specific role | Arabic: يتحقق إذا كان المستخدم لديه دور معين
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class, // English: Role check | Arabic: التحقق من الدور
            // English: Checks if the user has a specific permission | Arabic: يتحقق إذا كان المستخدم لديه صلاحية معينة
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
        ]);

        // Add to web group
        // English: Appends 'role' and 'permission' middleware to the web group for easy use in routes
        // Arabic: يضيف وسيط 'role' و 'permission' إلى مجموعة الويب لاستخدامها بسهولة في المسارات
        // $middleware->web(append: ['role', 'permission']);
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
