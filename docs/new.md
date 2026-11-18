# What is new in PHP 8.6

## Stream API

* Polling API — This is a low-level API that will help with threaded signal handling, improve FPM performance, and provide timer implementations, which is a key building block for async.

## clamp() Function (Standard Library)

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

## Duration Class

[This RFC](https://wiki.php.net/rfc/duration_class) is introducing a single class and starts using the Time for PHP’s standard library. `\Time\Duration` is intended as the first part and basic building block of a modernized date and time library for PHP, while already providing value by itself.

`\Time\Duration` a final readonly class that represents a stopwatch-style length of time with nanosecond precision.

### Exception

Throws a `\Time\TimeException`.

```php
namespace Time;

class TimeException extends \Exception { }
```

## Polling API (Core / I/O)

Performance-related addition in PHP 8.6. `Io\Poll` provides native (PHP) access to `epoll` (Linux) and `kqueue` (BSD/macOS) — the event notification mechanisms used by example Node.js, Nginx, and Go.

`Io\Poll` 

* [Revolt](https://revolt.run/): Can offer a pure-PHP, zero-dependency event loop.
* AMPHP: Runs on Revolt.
* ReactPHP: Can drop multiple backend drivers (stream_select, ext-event, ext-uv) and use Io\Poll as the default.
* Swoole/OpenSwoole: Doesn't need Io\Poll.

The Symfony team has a polyfill library: `symfony/polyfill-io-poll`

### [> Index](./index.md)
