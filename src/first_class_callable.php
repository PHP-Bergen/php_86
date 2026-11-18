<?php

// PHP 8.1 introduced First Class Callables.
// The (...) (ellipsis operator), must contain only ...; you cannot pre-fill any arguments.

$names = [' Alice ', ' Bob ', ' Charlie '];
$trimmedNames = array_map(trim(...), $names);

// Sort names alphabetically, ignoring case.
$names = ['Charlie', 'alice', 'Bob'];
usort($names, strcasecmp(...));




// PHP 8.5: each pipe passes its value as the callable's single argument.
// Wrap str_replace() in a closure to supply its search and replacement arguments.
$slug = ' Hello World '
    |> trim(...)
    |> (fn(string $text): string => str_replace(' ', '-', $text))
    |> strtolower(...);

// PHP 8.6, introduces the ? placeholder for remaining or variadic arguments.
$slugs = ' Hello World '
    |> trim(...)
    |> str_replace(' ', '-', ?)
    |> strtolower(...);

// The old way (PHP 8.0+)
$is_html = fn($val) => str_ends_with($val, '.html');

// The new way (PHP 8.6)
$is_html = str_ends_with(?, '.html');

// Use PHP native URI Parser.
$route = $_SERVER['REQUEST_URI']
    |> parse_url(?, PHP_URL_PATH)
    |> explode('/', ?)
    |> array_filter(?);

function summer(int $a, int $b): int
{
    return $a + $b;
}
$sum = summer(...);
echo $sum(3, 4);

