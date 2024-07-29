<?php

namespace Aptika\SsoGorontalo\Providers;

use Illuminate\Support\ServiceProvider;

class SSOServiceProvider extends ServiceProvider
{
    
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->publishes([
            __DIR__ . '/../config/aptika-sso.php' => config_path('aptika-sso.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/aptika-sso.php',
            'aptika-sso'
        );
    }
}
