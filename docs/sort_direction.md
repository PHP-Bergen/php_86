# New SortDirection Enum

The SortDirection enum provides a shared, type-safe way to express sort order with its Ascending and Descending cases. Previously, every library had to define its own way of representing sort direction, resulting in a mix of incompatible integers, strings, booleans, and custom enums. Since SortDirection is built into PHP, libraries can accept it in their public APIs without needing adapter code.

* https://wiki.php.net/rfc/sort_direction_enum
* https://thephp.foundation/blog/2026/11/03/stdlib-investment/

### [> Index](./index.md)
