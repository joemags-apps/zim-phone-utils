<?php

namespace JoemagsApps\ZimPhoneUtils\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \JoemagsApps\ZimPhoneUtils\ZimPhoneUtils
 */
class ZimPhoneUtils extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \JoemagsApps\ZimPhoneUtils\ZimPhoneUtils::class;
    }
}
