<?php

use JoemagsApps\ZimPhoneUtils\Utils;
use Illuminate\Support\Facades\Validator;

test('it formats phone numbers in national format', function () {
    expect(Utils::formatPhoneNumber('+263771234567'))->toBe('077 123 4567');
    expect(Utils::formatPhoneNumber('+263712345678'))->toBe('071 234 5678');
});

test('it formats phone numbers in international format', function () {
    expect(Utils::formatPhoneNumber('+263771234567', false))->toBe('+263 77 123 4567');
    expect(Utils::formatPhoneNumber('+263712345678', false))->toBe('+263 71 234 5678');
});

test('it extracts country ISO codes from phone numbers', function () {
    expect(Utils::getCountryIso('+263775234567'))->toBe('ZW');
    expect(Utils::getCountryIso('+27665612345'))->toBe('ZA');
});

test('it extracts country codes from phone numbers', function () {
    expect(Utils::getCountryCode('+263771234567'))->toBe(263);
    expect(Utils::getCountryCode('+1234567890'))->toBe(1);
});

test('it determines mobile carriers for phone numbers', function () {
    expect(Utils::getPhoneCarrier('+263771234567'))->toBe('Econet');
    expect(Utils::getPhoneCarrier('+263712345678'))->toBe('NetOne');
});

test('it validates phone numbers using the phone rule', function () {
    $validNumber = '+263771234567';
    $invalidNumber = '1234';

    $validatorValid = Validator::make(['phone' => $validNumber], ['phone' => 'phone']);
    $validatorInvalid = Validator::make(['phone' => $invalidNumber], ['phone' => 'phone']);

    expect($validatorValid->passes())->toBeTrue();
    expect($validatorInvalid->fails())->toBeTrue();
});

test('it validates phone numbers with specific country codes', function () {
    $zwNumber = '+263775234567';
    $zaNumber = '+27665612345';

    $validatorZW = Validator::make(['phone' => $zwNumber], ['phone' => 'phone:ZW']);
    $validatorZA = Validator::make(['phone' => $zaNumber], ['phone' => 'phone:ZA']);

    expect($validatorZW->passes())->toBeTrue();
    expect($validatorZA->passes())->toBeTrue();
});

test('it validates mobile carriers using the carrier rule', function () {
    $econetNumber = '+263771234567';
    $invalidCarrier = 'InvalidCarrier';

    $validatorValid = Validator::make(['carrier' => $econetNumber], ['carrier' => 'carrier:Econet,NetOne,Telecel']);
    $validatorInvalid = Validator::make(['carrier' => $invalidCarrier], ['carrier' => 'carrier:Econet,NetOne,Telecel']);

    expect($validatorValid->passes())->toBeTrue();
    expect($validatorInvalid->fails())->toBeTrue();
});