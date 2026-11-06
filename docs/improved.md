# What is improved in PHP 8.6

## Partial Function Application

PHP 8.1 introduced First Class Callables.

Partial Function Application (PFA) refers to the process of calling a function with only some of its required parameters, delaying the rest to a later time.

PFA is a core feature of a number of functional languages. While integrating it as a concept as deeply as, say, Haskell does is not feasible in PHP, the ergonomic benefits of PFA make it a key component of PHP's growing functional capabilities.

* https://wiki.php.net/rfc/partial_function_application_v2

### Limitations

* No references: `$func = modify($byRef, ?)` does not work with & parameters.
* No variadic unpacking: `someFunc(?, ...$args)` is not supported.
* Cannot partially apply named arguments: PFA only works with positional arguments.
* Type safety: Type hints are preserved; passing wrong types throws TypeError.

## Stream API

Swiss too used to everything from making HTTP requests to providing building blocks for async processing. Have a reputation to be also a huge mess. We get a lot of improvements that makes it more robust and helps enable future async processing features.

    * Improvements to Stream API's Error Handling
    * Performace improvments, TLS Session Resumption.

### [> Index](./index.md)
