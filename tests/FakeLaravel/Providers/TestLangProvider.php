<?php

namespace ElaborateCode\LaravelJsonTongue\Tests\FakeLaravel\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class TestLangProvider extends ServiceProvider
{
    public function boot()
    {
        app()->useLangPath(__DIR__.'/../lang');
    }
}
