<?php

namespace ElaborateCode\LaravelJsonTongue\Tests;

use ElaborateCode\LaravelJsonTongue\JsonTongueServiceProvider;
use ElaborateCode\LaravelJsonTongue\Tests\FakeLaravel\Providers\TestLangProvider;
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
            TestLangProvider::class,
        ];
    }
}
