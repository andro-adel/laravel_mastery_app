<?php
/**
 * Web Routes
 *
 * English: Defines routes for web (browser) requests. These routes are loaded by the RouteServiceProvider within a group containing the "web" middleware group.
 * Arabic: يحدد المسارات لطلبات الويب (المتصفح). يتم تحميل هذه المسارات بواسطة RouteServiceProvider ضمن مجموعة تحتوي على مجموعة وسيط "web".
 */

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
