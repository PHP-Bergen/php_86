# PHP 8.6 deprecations

* https://wiki.php.net/rfc/deprecations_php_8_6
* https://php.watch/rfcs


## Returning from a finally block

Returning from a finally has always been very confusing and a cause of subtle bugs. This is deprecated now.

```php
function getConfig(): array 
{
    try {
        return loadConfig();
    } finally {
        return [];
    }
}
```

## Deprecate returning values from __construct() and __destruct()

https://wiki.php.net/rfc/deprecate-return-value-from-construct

```php
class Foo
{
    public function __construct()
    {
    return 123; // Deprecated: Returning a value from a constructor is deprecated in test.php on line 6
    }
 
    public function __destruct()
    {
    return 123; // Deprecated: Returning a value from a constructor is deprecated in test.php on line 12
    }
}
```

## Identifiers

* Deprecate using `let` as an identifier.
* Deprecate using `is` as an identifier.

## PHP RFC: Limit maximum number of filter chains
https://wiki.php.net/rfc/limit-maximum-number-of-filter-chains Limit the number of individual filter components allowed in a single `php://filter` string.

```
Deprecated: Using more than 16 filters in a php://filter URL is deprecated, 
set this limit using the stream context option max_filter_count, 
or use stream_filter_append in ...
```
Error (when filter.max_filter_count is set, or in later PHP version).

No PHP INI setting for this, but can be altered using the stream context option `filter.max_filter_count`.

## PHP RFC: Secure Session Configuration Defaults

https://wiki.php.net/rfc/session_security_defaults. Three ini settings in PHP's session extension have security implications.

* `session.use_strict_mode` — reject unrecognised session IDs supplied by the client.
* `session.cookie_httponly` — exclude the session cookie from the JavaScript cookie API. 
* `session.cookie_samesite` — restrict cross-site delivery of the session cookie.

Ship with defaults that leave applications unnecessarily exposed.

## PHP RFC: Oniguruma maintenance end and end of mbregex
https://wiki.php.net/rfc/eol-oniguruma All `mbregex` —functions. Oniguruma is a regular expressions library that was EOL 24-04-2025.


### [> Index](./index.md)
