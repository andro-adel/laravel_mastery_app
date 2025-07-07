<?php
/**
 * Public Index File
 *
 * English: The entry point for all HTTP requests to the application. Handles incoming requests and sends responses.
 * Arabic: نقطة الدخول لجميع طلبات HTTP إلى التطبيق. يتعامل مع الطلبات الواردة ويرسل الاستجابات.
 */

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
