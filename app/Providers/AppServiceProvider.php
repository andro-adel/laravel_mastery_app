<?php
/**
 * App Service Provider
 *
 * English: Registers application services and performs bootstrapping tasks. Used to bind services into the service container.
 * Arabic: يسجل خدمات التطبيق ويقوم بمهام التهيئة. يُستخدم لربط الخدمات في حاوية الخدمات.
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
