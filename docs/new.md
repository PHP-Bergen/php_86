# What is new in PHP 8.6

## Stream API

* Polling API — This is a low-level API that will help with threaded signal handling, improve FPM performance, and provide timer implementations, which is a key building block for async.

## clamp() Function

`clamp()` — clamp() is a new function that returns a value that is constrained to a specified range. It is useful for limiting values to a certain range, such as when working with numerical data.

```php
// PHP 8.5 and older.
if ($x < 0) return 0; if ($x > 100) return 100;
```

```php
// PHP 8.6 and newer.
clamp($x, 0, 100);
```

### [> Index](./index.md)
