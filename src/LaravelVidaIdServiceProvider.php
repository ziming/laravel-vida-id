<?php

namespace Ziming\LaravelVidaId;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Ziming\LaravelVidaId\Commands\LaravelVidaIdCommand;

class LaravelVidaIdServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-vida-id')
            ->hasConfigFile();
    }
}
