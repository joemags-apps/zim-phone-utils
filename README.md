# A Laravel package for working with phone numbers in the Zimbabwean context

[![Latest Version on Packagist](https://img.shields.io/packagist/v/joemags-apps/zim-phone-utils.svg?style=flat-square)](https://packagist.org/packages/joemags-apps/zim-phone-utils)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/joemags-apps/zim-phone-utils/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/joemags-apps/zim-phone-utils/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/joemags-apps/zim-phone-utils/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/joemags-apps/zim-phone-utils/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/joemags-apps/zim-phone-utils.svg?style=flat-square)](https://packagist.org/packages/joemags-apps/zim-phone-utils)

Zim Phone Utils is a Laravel package that provides a set of utility functions and custom validation rules for working with phone numbers in the Zimbabwean context. It simplifies tasks such as formatting phone numbers, extracting country codes, determining mobile carriers, and validating phone numbers against specific criteria.

## Features

- Format phone numbers in national or international format
- Extract country ISO codes and country codes from phone numbers
- Determine the mobile carrier for a given phone number
- Custom validation rules for phone numbers and mobile carriers
- Seamless integration with Laravel's validation system

## Installation

You can install the package via composer:

```bash
composer require joemags-apps/zim-phone-utils
```

## Usage

```php
use JoemagsApps\ZimPhoneUtils\Utils;

// Format a phone number
$formattedNumber = Utils::formatPhoneNumber('+263771234567');

// Get the country ISO code
$countryIso = Utils::getCountryIso('+263771234567');

// Get the mobile carrier
$carrier = Utils::getPhoneCarrier('+263771234567');

// Validate a phone number
$request->validate([
    'phone' => 'required|phone:ZW',
]);

// Validate a mobile carrier
$request->validate([
    'carrier' => 'required|carrier:Econet,NetOne,Telecel',
]);
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Joe Munapo](https://github.com/joemags-apps)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
