# Pagination

The simple pagination

[![Downloads](https://img.shields.io/packagist/dt/amstaffix/pagination.svg?style=flat-square)](https://packagist.org/packages/amstaffix/pagination)
[![License](https://img.shields.io/packagist/l/amstaffix/pagination.svg?style=flat-square)](http://opensource.org/licenses/MIT)

## Requirements

- PHP >= 5.3.3

## Usage

```php
use Kilte\Pagination\Pagination;
$pagination = new Pagination($totalItems, $currentPage, $itemsPerPage, $neighbours);
$offset = $pagination->offset();
$limit = $pagination->limit();
$listing = $someInstance->listing($offset, $limit);
$pages = $pagination->build(); // Contains associative array with a numbers of a pages
// For example:
/*
    array(
        1 => 'first',
        5 => 'less',
        6 => 'previous', // This interval
        7 => 'previous', // is defined
        8 => 'previous', // by
        9 => 'previous', // $neighbours argument
        10 => 'current', // Current page
        11 => 'next',
        12 => 'next',
        13 => 'next',
        14 => 'next',
        15 => 'more',
        20 => 'last'
    )
*/
```

Note: Tags (like *first*, *current*, ...) are defined as constants in the Pagination class
(```TAG_FIRST```, ```TAG_CURRENT```, ...).

## Tests

```bash
$ composer install
$ vendor/bin/phpunit
```

## Contributing

[Contribution process](CONTRIBUTING.md)

## CHANGELOG

[Changelog](CHANGELOG.md)

# LICENSE

The MIT License (MIT)
