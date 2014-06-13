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
