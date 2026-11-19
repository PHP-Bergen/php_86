# What is new in PHP 8.6
 
## [Partial Function Application: Handling of Optional Parameters](https://wiki.php.net/rfc/partial_function_application_optional_placeholder)

Parameters generated from ? placeholders shall consistently be non-optional parameters. Parameters that are pulled in by a `...` placeholder shall continue to inherit their “optionality”. [PFA](pfa.md)

## [Polling API (Core / I/O)](polling.md)

I/O polling (also called I/O multiplexing) is a mechanism that allows a program to efficiently monitor multiple I/O resources (like network sockets, pipes, or files) simultaneously and be notified when any of them are ready for reading, writing. [RFC](https://wiki.php.net/rfc/poll_api).

## [clamp() Function (Standard Library)](clamp.md)

Ensures that a given value (numeric or otherwise) falls within a specified range. Otherwise, the nearest boundary value is returned. [RFC clamp()](clamp.md).

## [New \Time\Duration Class](duration.md)

The Duration class represents elapsed time as measured by a stopwatch. Its representation is independent of any time and timezone and can represent a range of more than 250 years with nanosecond precision. This makes it well-suited to represent timeouts or benchmark timings in an expressive way.

## [Readonly Property Defaults](readonly_property_defaults.md)

Instance readonly properties, including those in readonly classes, can now declare a default value. This makes it simple to implement get-only interface properties with fixed values, which previously required assigning them in a constructor. The default counts as the property's initialization, so the constructor cannot overwrite it.

## [New SortDirection Enum](sort_direction.md)

The SortDirection enum provides a shared, type-safe way to express sort order with its Ascending and Descending cases. Previously, every library had to define its own way of representing sort direction, resulting in a mix of incompatible integers, strings, booleans, and custom enums. Since SortDirection is built into PHP, libraries can accept it in their public APIs without needing adapter code.

### [> Index](./index.md)
