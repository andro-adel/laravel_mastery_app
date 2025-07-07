<?php
/**
 * Console Routes
 *
 * English: Defines closure-based console commands for the application. These commands are registered when running Artisan commands.
 * Arabic: يحدد أوامر وحدة التحكم المعتمدة على الإغلاق للتطبيق. يتم تسجيل هذه الأوامر عند تشغيل أوامر Artisan.
 */

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
