<?php

namespace JoemagsApps\ZimPhoneUtils\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \JoemagsApps\ZimPhoneUtils\ZimPhoneUtils
 */
class Utils extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \JoemagsApps\ZimPhoneUtils\Utils::class;
    }
}
