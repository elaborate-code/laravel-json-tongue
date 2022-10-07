<?php

namespace ElaborateCode\LaravelJsonTongue\Tests;

use ElaborateCode\LaravelJsonTongue\JsonTongueServiceProvider;
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
            JsonTongueServiceProvider::class,
        ];
    }

    protected function getBasePath()
    {
        return __DIR__.'/laravel/';
    }
}
