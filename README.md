# Pagination

The simple pagination

[![Build Status](https://img.shields.io/travis/Kilte/pagination.svg?style=flat-square)](https://travis-ci.org/Kilte/pagination)
[![Downloads](https://img.shields.io/packagist/dt/kilte/pagination.svg?style=flat-square)](https://packagist.org/packages/kilte/pagination)
[![License](https://img.shields.io/packagist/l/kilte/pagination.svg?style=flat-square)](http://opensource.org/licenses/MIT)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/fd98f4ee-e07d-40d8-b25a-7b8b0e59ca3b.svg?style=flat-square)](https://insight.sensiolabs.com/projects/fd98f4ee-e07d-40d8-b25a-7b8b0e59ca3b)

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

- Fork it
- Create your feature branch (git checkout -b awesome-feature)
- Make your changes
- Write/update tests, if it necessary
- Update `README.md`, if it necessary
- Push your branch to origin (git push origin awesome-feature)
- Send pull request
- ???
- PROFIT!!!

Do not forget merge upstream changes:

    git remote add upstream https://github.com/Kilte/pagination
    git checkout master
    git pull upstream
    git push origin master

Now you can to remove your branch:

    git branch -d awesome-feature
    git push origin :awesome-feature

## CHANGELOG

### 1.1.2 \[27.12.2014\]

- Added `totalPages()` method

### 1.1.1 \[31.08.2014\]

- Small improvements

### 1.1.0 \[16.06.2014\]

- Improved pages array to include relative positions
- Added constants to define position tags

### 1.0.0 \[25.02.2014\]

- Initial release

# LICENSE

The MIT License (MIT)
