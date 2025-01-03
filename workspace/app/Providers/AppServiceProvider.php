<?php

namespace App\Providers;

use App\Http\Kernel;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Connection;
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
        DB::whenQueryingForLongerThan(500, function (Connection $connection) {
            logger()
                ->channel('telegram')
                ->debug('whenQueryingForLongerThan: ' . $connection->query()->toSql());
        });

        $kernel = app(Kernel::class);
        $kernel->whenRequestLifecycleIsLongerThan(
            CarbonInterval::seconds(4),
            function () {
                logger()
                    ->channel('telegram')
                    ->debug('whenRequestLifecycleIsLongerThan: ' . request()->url());
            }
        );

        // if (env('LOG_LEVEL') === 'debug') {
        //     DB::listen(function ($query) {
        //         dump($query->sql, $query->bindings);
        //     });
        // }
    }
}
