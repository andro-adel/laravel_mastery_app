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
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
