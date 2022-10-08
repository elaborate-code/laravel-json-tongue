<?php

namespace ElaborateCode\LaravelJsonTongue;

use ElaborateCode\LaravelJsonTongue\Commands\JsonTongueMergeCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class JsonTongueServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-json-tongue')
            ->hasConfigFile()
            ->hasCommand(JsonTongueMergeCommand::class);
    }
}
