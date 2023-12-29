<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
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
        Model::shouldBeStrict(!app()->isProduction());
        // DB::whenQueryingForLongerThan(500, function (Connection $connection) {
        // });

        // if (env('LOG_LEVEL') === 'debug') {
        //     DB::listen(function ($query) {
        //         dump($query->sql, $query->bindings);
        //     });
        // }
    }
}
