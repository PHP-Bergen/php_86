# Polling API (Core / I/O)

The new Io\Poll API efficiently monitors many streams at once using the best mechanism available on each platform (epoll (Linux), kqueue (macOS/BSD), event ports, or WSAPoll (Windows), without the scalability limits of stream_select(). It is designed as a common foundation that event loop libraries such as ReactPHP and AMPHP can build on.

Performance-related addition in PHP 8.6. `Io\Poll` provides native (PHP) access to `epoll` (Linux) and `kqueue` (BSD/macOS) — the event notification mechanisms used by example Node.js, Nginx, and Go.

`Io\Poll`

* [Revolt](https://revolt.run/): Can offer a pure-PHP, zero-dependency event loop.
* AMPHP: Runs on Revolt.
* ReactPHP: Can drop multiple backend drivers (stream_select, ext-event, ext-uv) and use Io\Poll as the default.
* Swoole/OpenSwoole: Doesn't need Io\Poll.

The Symfony team has a polyfill library: `symfony/polyfill-io-poll`

### [> Index](./index.md)
