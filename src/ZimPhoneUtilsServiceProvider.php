<?php

namespace JoemagsApps\ZimPhoneUtils;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use JoemagsApps\ZimPhoneUtils\Commands\ZimPhoneUtilsCommand;

class ZimPhoneUtilsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('zim-phone-utils')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_zim-phone-utils_table')
            ->hasCommand(ZimPhoneUtilsCommand::class);
    }
}
