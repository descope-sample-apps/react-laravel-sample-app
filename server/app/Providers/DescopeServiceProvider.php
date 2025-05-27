<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Descope\SDK\DescopeSDK;

class DescopeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(DescopeSDK::class, function ($app) {
            return new DescopeSDK([
                'projectId' => env('DESCOPE_PROJECT_ID'),
                'managementKey' => env('MANAGEMENT_KEY'),
            ]);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
