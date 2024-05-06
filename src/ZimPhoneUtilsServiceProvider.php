<?php

namespace JoemagsApps\ZimPhoneUtils;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasConfigFile();
    }

    public function bootingPackage()
    {
        CustomValidation::loadRules();
    }
}
