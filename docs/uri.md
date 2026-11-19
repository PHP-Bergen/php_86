# Improvements for ext/uri

https://wiki.php.net/rfc/uri_followup

* URI Building
* URI Type Detection
* Host Type Detection
* Percent-Encoding Support

## URI Building

URIs can be in PHP 8.5 already be manipulated via [wither](https://wiki.php.net/rfc/url_parsing_api#component_modification) (Component modification) methods.

```php
// PHP 8.5
$uri1 = Uri\Rfc3986\Uri::parse("http://php-bergen.no");
$uri2 = $uri1
    ->withScheme("https")
    ->withHost("phpbergen.no")
    ->withPath("/foo/bar");
$uri2->toString(); // https://phpbergen.no/foo/bar
```
Immutable but performance is not great as it creates 3 object. URI creation from the scratch is currently not possible. You always have to create a valid URI first.

```php
// Create stub and then populate.
$uri = Uri\Rfc3986\Uri::parse("");
```

## URI building in PHP 8.6

```php
$uriBuilder = new Uri\Rfc3986\UriBuilder()
    ->setScheme("https")
    ->setUserInfo("admin:admin")
    ->setHost("phpbergen.no")
    ->setPort(8080)
    ->setPath("/beer/bar")
    ->setQuery("a=1&b=2")
    ->setFragment("section1");

$uri = $uriBuilder->build();
$uri->toRawString(); // https://phpbergen.no/foo/barhttps://admin:admin@phpbergen.no:8080/beer/bar?a=1&b=2#section1
```

Or using the URL builder:

```php
$urlBuilder = new Uri\WhatWg\UrlBuilder()
    ->setScheme("https")
    ->setUsername("user")
    ->setPassword("pass")
    ->setHost("example.com")
    ->setPort(8080)
    ->setPath("/foo/bar")
    ->setQuery("a=1&b=2")
    ->setFragment("section1");

$url = $urlBuilder->build();
$url->toAsciiString(); // https://user:pass@example.com:8080/foo/bar?a=1&b=2#section1
```

## Validation

```php
$uriBuilder = new Uri\Rfc3986\UriBuilder()
    ->setScheme("http%80"); // Fatal error:  Uncaught Uri\InvalidUriException: The specified scheme is malformed.
$uriBuilder = new Uri\Rfc3986\UriBuilder()
    ->setScheme("https")
    ->setUserInfo("helge:1234"); // No error here.
$uriBuilder->build(); // Fatal error:  Uncaught Uri\InvalidUriException: Cannot set a userinfo without having a host.
```

## Type detection

```php
$uri = new Uri\Rfc3986\Uri("https://example.com"); // Uri\Rfc3986\UriType::Uri
$uri = new Uri\Rfc3986\Uri("/foo"); // Uri\Rfc3986\UriType::AbsolutePathReference
$uri = new Uri\Rfc3986\Uri("foo"); // Uri\Rfc3986\UriType::RelativePathReference
$uri = new Uri\Rfc3986\Uri("//host.com/foo"); // Uri\Rfc3986\UriType::NetworkPathReference
$uri->getUriType();

```

## Host detection


```php
$uri = new Uri\Rfc3986\Uri("https://192.168.0.1/");
print_r($uri->getHostType());

(
    [name] => IpV4
)
```

Examples:

```php
$uri = new Uri\Rfc3986\Uri("https://192.168.0.1/"); // UriHostType::IpV4
$uri = new Uri\Rfc3986\Uri("https://[2001:db8::1]/"); // UriHostType::IpV6
$uri = new Uri\Rfc3986\Uri("https://[v1.1.2.3]/"); // UriHostType::IpVFuture
$uri = new Uri\Rfc3986\Uri("https://example.com/"); // UriHostType::RegisteredName
$uri = new Uri\Rfc3986\Uri("file:///C:/a.txt"); // null
$uri = new Uri\Rfc3986\Uri("foo:bar/baz"); // null
$uri = new Uri\Rfc3986\Uri("/foo/bar"); // null
$uri = new Uri\Rfc3986\Uri("mailto:john.doe@example.com"); // null
```



## [Percent-Encoding Support](https://wiki.php.net/rfc/uri_followup#percent-encoding_support)

```php
echo PHP_EOL . rawurlencode("/foo/bar/baz");

%2Ffoo%2Fbar%2Fbaz
```

### [> Index](./index.md)
