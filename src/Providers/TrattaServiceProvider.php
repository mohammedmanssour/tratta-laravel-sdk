<?php

namespace Mohammedmanssour\TrattaLaravelSdk\Providers;

use Illuminate\Support\ServiceProvider;
use Mohammedmanssour\TrattaLaravelSdk\Services\TrattaService;
use Mohammedmanssour\TrattaLaravelSdk\Support\TrattaEnvironment;

class TrattaServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/config.php' => config_path('tratta.php'),
        ], 'tratta-config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/config.php',
            'tratta'
        );

        $this->packageRegistered();
    }

    public function packageRegistered()
    {
        $this->app->singleton(
            TrattaService::class,
            fn () => new TrattaService(
                config('tratta.org_id'),
                config('tratta.api_key'),
                TrattaEnvironment::from(config('tratta.environment'))
            )
        );
    }
}
