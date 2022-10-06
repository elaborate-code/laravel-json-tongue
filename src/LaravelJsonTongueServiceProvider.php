<?php

namespace ElaborateCode\LaravelJsonTongue;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use ElaborateCode\LaravelJsonTongue\Commands\LaravelJsonTongueCommand;

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