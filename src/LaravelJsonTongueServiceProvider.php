<?php

namespace ElaborateCode\LaravelJsonTongue;

use ElaborateCode\LaravelJsonTongue\Commands\LaravelJsonTongueCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelJsonTongueServiceProvider extends PackageServiceProvider
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
            ->hasViews()
            ->hasMigration('create_laravel-json-tongue_table')
            ->hasCommand(LaravelJsonTongueCommand::class);
    }
}
