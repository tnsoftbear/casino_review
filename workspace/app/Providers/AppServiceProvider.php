<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

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
        // if (env('LOG_LEVEL') === 'debug') {
        //     DB::listen(function ($query) {
        //         dump($query->sql, $query->bindings);
        //     });
        // }
    }
}
