# Pagination

The simple pagination

## Requirements

- PHP >= 5.3.3

## Usage

    use Kilte\Pagination\Pagination;
    $pagination = new Pagination($totalItems, $currentPage, $itemsPerPage, $neighbours);
    $offset = $pagination->offset();
    $limit = $pagination->limit();
    $listing = $someInstance->listing($offset, $limit);
    $pages = $pagination->build(); // Contains associative array with a numbers of a pages
    // For example:
    /*
        array(
            1 => 1,
            5 => "...",
            6 => 6, // This  interval
            7 => 7, // defined
            8 => 8, // by
            9 => 9, // $neighbours argument
            10 => false, // Current page
            11 => 11,
            12 => 12,
            13 => 13,
            14 => 14,
            15 => "...",
            20 => 20
        )
    */

## Tests

    $ composer install --dev
    $ vendor/bin/phpunit

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

# LICENSE

The MIT License (MIT)