<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GlobalViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        view()->share('siteTitle', __('global.site_title'));
        view()->share('metaDescription', __('global.site_description'));
    }
}
