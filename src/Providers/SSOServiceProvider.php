<?php

namespace Aptika\SsoGorontalo\Providers;

use Illuminate\Support\ServiceProvider;

class SSOServiceProvider extends ServiceProvider
{
    
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->publishes([
            dirname(__DIR__) . '/../publishable/config/aptika-sso.php' => config_path('aptika-sso.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__). '/../publishable/config/aptika-sso.php',
            'aptika-sso'
        );
    }
}
