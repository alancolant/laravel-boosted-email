<?php

namespace Alancolant\LaravelBoostedEmail;

use Illuminate\Support\ServiceProvider;

class LaravelBoostedEmailServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/boosted-email.php' => config_path('boosted-email.php'),
            ], 'config');
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/boosted-email.php', 'boosted-email');
    }
}
