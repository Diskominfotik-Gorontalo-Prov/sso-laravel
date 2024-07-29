<?php

namespace Aptika\SsoGorontalo\Providers;

use Illuminate\Support\ServiceProvider;

class SSOServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    public function register()
    {
        //
    }
}
