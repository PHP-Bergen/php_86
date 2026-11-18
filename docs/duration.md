#  New \Time\Duration Class

[This RFC](https://wiki.php.net/rfc/duration_class) is introducing a single class and starts using the Time for PHP’s standard library. `\Time\Duration` is intended as the first part and basic building block of a modernized date and time library for PHP, while already providing value by itself.

`\Time\Duration` a final readonly class that represents a stopwatch-style length of time with nanosecond precision.

## Exception

Throws a `\Time\TimeException`.

```php
namespace Time;

class TimeException extends \Exception 
{ 
    
}
```

### [> Index](./index.md)
