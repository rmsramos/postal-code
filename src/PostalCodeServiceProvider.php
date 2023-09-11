<?php

namespace Rmsramos\PostalCode;

use Rmsramos\PostalCode\Commands\PostalCodeCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PostalCodeServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('postal-code')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_postal-code_table')
            ->hasCommand(PostalCodeCommand::class);
    }
}
