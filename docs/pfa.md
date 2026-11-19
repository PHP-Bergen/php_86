# Partial Function Application - PFA (Syntax / DX)

PHP 8.1 introduced First Class Callables. The `...` Placeholder for remaining or variadic arguments.

Partial Function Application (PFA) refers to the process of calling a function with only some of its required parameters, delaying the rest to a later time.

## Background

PFA is a core feature of a number of functional languages. While integrating it as a concept as deeply as, say, Haskell does is not feasible in PHP, the ergonomic benefits of PFA make it a key component of PHP's growing functional capabilities.

## Use

The `?` Placeholder for a single positional argument.

PFA is especially useful when combined with the pipe operator, because the pipe operator always requires a callable with exactly one parameter. Instead of wrapping a function in a closure to fix certain arguments, you can now use the ? placeholder.

### Examples

```php
$is_html = str_ends_with(?, '.html');
```

* [FCC code](../src/first_class_callable.php)

### Limitations

* No references: `$func = modify($byRef, ?)` does not work with & parameters.
* No variadic unpacking: `someFunc(?, ...$args)` is not supported.
* Cannot partially apply named arguments: PFA only works with positional arguments.
* Type safety: Type hints are preserved; passing wrong types throws TypeError.

## Description

Allows some of a function's arguments to be provided in advance, using ? and ... placeholders for the rest. The result is a Closure, and the function is only called once the remaining arguments are passed to it.

### References

* https://wiki.php.net/rfc/partial_function_application_v2
* https://wiki.php.net/rfc/partial_function_application_optional_placeholder

### [> Index](./index.md)
