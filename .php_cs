<?php

$finder = \Symfony\CS\Finder\DefaultFinder::create()
    ->files()
    ->name('*.php')
    ->in(__DIR__ . '/src/')
;

return \Symfony\CS\Config\Config::create()->finder($finder);
