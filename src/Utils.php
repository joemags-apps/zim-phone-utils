<?php

namespace JoemagsApps\ZimPhoneUtils;

use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberToCarrierMapper;
use libphonenumber\PhoneNumberUtil;

class Utils
{
    /**
     * @var PhoneNumberUtil
     */
    protected static $phoneUtil;

    /**
     * @var PhoneNumberToCarrierMapper
     */
    protected static $carrierMapper;

    /**
     * Initialize the phone utility instance.
     *
     * @return void
     */
    protected static function initializePhoneUtil()
    {
        if (!self::$phoneUtil) {
            self::$phoneUtil = PhoneNumberUtil::getInstance();
        }
    }

    /**
     * Initialize the carrier mapper instance.
     *
     * @return void
     */
    protected static function initializeCarrierMapper()
    {
        if (!self::$carrierMapper) {
            self::$carrierMapper = PhoneNumberToCarrierMapper::getInstance();
        }
    }

    /**
     * Get the country ISO code for a given phone number.
     *
     * @param string $phone The phone number.
     * @return string|null The country ISO code or null if not found.
     */
    public static function getCountryIso(string $phone): ?string
    {
        self::initializePhoneUtil();

        try {
            $phoneNumber = self::$phoneUtil->parse($phone);
            $countryIso = self::$phoneUtil->getRegionCodeForNumber($phoneNumber);
            return $countryIso;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Get the country code for a given phone number.
     *
     * @param string $phone The phone number.
     * @return int|null The country code or null if not found.
     */
    public static function getCountryCode(string $phone): ?int
    {
        self::initializePhoneUtil();

        try {
            $phoneNumber = self::$phoneUtil->parse($phone);
            return $phoneNumber->getCountryCode();
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Format a phone number in either national or international format.
     *
     * @param string $phone The phone number.
     * @param bool $national Whether to format in national format (default: true).
     * @param string $defaultRegion The default region code (default: 'ZW').
     * @return string The formatted phone number.
     */
    public static function formatPhoneNumber(string $phone, bool $national = true, string $defaultRegion = 'ZW'): string
    {
        self::initializePhoneUtil();

        try {
            $phoneNumber = self::$phoneUtil->parse($phone, $defaultRegion);
            $format = $national ? PhoneNumberFormat::NATIONAL : PhoneNumberFormat::INTERNATIONAL;
            $formatted = self::$phoneUtil->format($phoneNumber, $format);
            $formatted = str_replace([' ', '-', '(', ')', '+'], '', $formatted);
            return $formatted;
        } catch (\Exception $e) {
            return '';
        }
    }

    /**
     * Get the carrier name for a given phone number.
     *
     * @param string $phone The phone number.
     * @param bool $official Whether to return the official carrier name (default: false).
     * @return string|null The carrier name or null if not found.
     */
    public static function getPhoneCarrier(string $phone, bool $official = false): ?string
    {
        self::initializePhoneUtil();
        self::initializeCarrierMapper();

        try {
            $phoneNumber = self::$phoneUtil->parse($phone, 'ZW');
            $carrierName = self::$carrierMapper->getNameForNumber($phoneNumber, 'en');
            return $official ? $carrierName : str_replace('*', '', $carrierName);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Check if a given phone number is valid.
     *
     * @param string $phone The phone number.
     * @param string $defaultRegion The default region code (default: 'ZW').
     * @return bool Whether the phone number is valid.
     */
    public static function isValidPhoneNumber(string $phone, string $defaultRegion = 'ZW'): bool
    {
        self::initializePhoneUtil();

        try {
            $phoneNumber = self::$phoneUtil->parse($phone, $defaultRegion);
            return self::$phoneUtil->isValidNumber($phoneNumber);
        } catch (\Exception $e) {
            return false;
        }
    }
}
