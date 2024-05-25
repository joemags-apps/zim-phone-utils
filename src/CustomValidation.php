<?php

namespace JoemagsApps\ZimPhoneUtils;

use Illuminate\Support\Facades\Validator;

class CustomValidation
{
    public static function loadRules()
    {
        Validator::extend('carrier', function ($attribute, $value, $parameters, $validator) {
            $carrier = Utils::getPhoneCarrier($value);
            $carrier = strtolower($carrier);
            $parameters = array_map('strtolower', $parameters);
            if(in_array($carrier, $parameters)) return  true;
            $carrier_str = implode(', ', $parameters);
            $validator->addReplacer('carrier', fn() => "The mobile number must be a number from the following carriers: {$carrier_str}");
            return false;
        });

        Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
            try {
                $isValid = Utils::isValidPhoneNumber($value);
                throw_if(!$isValid, new \Exception('Invalid phone number'));

                if (!empty($parameters)) {
                    $countryIsoCode = Utils::getCountryIso($value);
                    $isMatch = in_array(strtoupper($countryIsoCode), $parameters);
                    return $isMatch;
                }

                return $isValid;
            } catch (\Throwable $th) {
                return false;
            }
        }, 'The :attribute is not a valid phone number' . (!empty($parameters) ? ' or not from the following countries: :countries.' : '.'));
    }
}
