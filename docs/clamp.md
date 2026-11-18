# clamp() Function (Standard Library)

`clamp()` — clamp() is [a new function](https://wiki.php.net/rfc/clamp_v2) that returns a value that is constrained to a specified range. It is useful for limiting values to a certain range, such as when working with numerical data.

```php
// PHP 8.5 and older.
if ($x < 0) return 0; if ($x > 100) return 100;
// If
($value < $min) ? $min : ( ($value > $max) ? $max : $value )
```

```php
// PHP 8.6 and newer.
clamp($x, 0, 100);
```

### [> Index](./index.md)
