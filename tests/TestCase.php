<?php

namespace ElaborateCode\LaravelJsonTongue\Tests;

use ElaborateCode\LaravelJsonTongue\LaravelJsonTongueServiceProvider;
use ElaborateCode\LaravelJsonTongue\Tests\FakeLaravel\Providers\TestLangProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        app()->setLocale('fr');

        $this->baseTestingPath = '/tests/FakeLaravel';
        $this->tempTestingPath = '/lang';

        config(['json-tongue.lang-path' => "{$this->baseTestingPath}{$this->tempTestingPath}"]);
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelJsonTongueServiceProvider::class,
            TestLangProvider::class,
        ];
    }
}
