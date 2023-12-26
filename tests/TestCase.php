<?php

namespace Alancolant\LaravelBoostedEmail\Tests;

use Alancolant\LaravelBoostedEmail\LaravelBoostedEmailServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelBoostedEmailServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-boosted-email_table.php.stub';
        $migration->up();
        */
    }
}
