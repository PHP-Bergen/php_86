# What is improved in PHP 8.6

## Partial Function Application - PFA (Syntax / DX)

PHP 8.1 introduced First Class Callables. The `...` Placeholder for remaining or variadic arguments.

Partial Function Application (PFA) refers to the process of calling a function with only some of its required parameters, delaying the rest to a later time.

PFA is a core feature of a number of functional languages. While integrating it as a concept as deeply as, say, Haskell does is not feasible in PHP, the ergonomic benefits of PFA make it a key component of PHP's growing functional capabilities.

The `?` Placeholder for a single positional argument.

* https://wiki.php.net/rfc/partial_function_application_v2

PFA is especially useful when combined with the pipe operator, because the pipe operator always requires a callable with exactly one parameter. Instead of wrapping a function in a closure to fix certain arguments, you can now use the ? placeholder.

```php
$is_html = str_ends_with(?, '.html');
```

### Limitations

* No references: `$func = modify($byRef, ?)` does not work with & parameters.
* No variadic unpacking: `someFunc(?, ...$args)` is not supported.
* Cannot partially apply named arguments: PFA only works with positional arguments.
* Type safety: Type hints are preserved; passing wrong types throws TypeError.

## Stream API

Swiss too used to everything from making HTTP requests to providing building blocks for async processing. Have a reputation to be also a huge mess. We get a lot of improvements that makes it more robust and helps enable future async processing features.

    * Improvements to Stream API's Error Handling
    * Performace improvments, TLS Session Resumption.

## Readonly Property Defaults (Type System)

Since PHP 8.1 introduced readonly properties and PHP 8.2 introduced readonly classes, immutable Data Transfer Objects (DTOs) and Domain Entities have become standard in modern PHP. Useful but they had one annoying limitation, you could not define default values for readonly properties in property declarations. 

* If you wanted a fixed value on a class, you used a class constant.

Then PHP 8.4 shipped interface properties, allowing you to write a contract that requires an instance property.


https://wiki.php.net/rfc/readonly_property_defaults


## PHP RFC: SNMP improvements for encryption protocols, mib reset, and controlling output

* https://github.com/net-snmp/net-snmp 
* https://www.net-snmp.org/ - https://github.com/net-snmp/net-snmp

### [> Index](./index.md)
