<?php

$message = "Hello, World!";

// Example
// improvements to the URL Parsing API
// https://wiki.php.net/rfc/uri_followup

/**
 * Improvements to the URL Parsing API.
 *
 * URI Building
 * URI Type Detection
 * Host Type Detection
 * Percent-Encoding Support
 */

// PHP 8.5
$uri1 = Uri\Rfc3986\Uri::parse("http://php-bergen.no");
$uri2 = $uri1
    ->withScheme("https")
    ->withHost("phpbergen.no")
    ->withPath("/foo/bar");
echo $uri2->toString();
// Performance: Create 3 object
// URI creation from the scratch is currently not possible: one always has to create a valid URI first.
// $uri1 = Uri\Rfc3986\Uri::parse("");


// Builder
$uriBuilder = new Uri\Rfc3986\UriBuilder()
    ->setScheme("https")
    ->setUserInfo("admin:admin")
    ->setHost("phpbergen.no")
    ->setPort(8080)
    ->setPath("/beer/bar")
    ->setQuery("a=1&b=2")
    ->setFragment("section1");

$uri = $uriBuilder->build();
echo PHP_EOL . $uri->toRawString(); // https://phpbergen.no/foo/barhttps://admin:admin@phpbergen.no:8080/beer/bar?a=1&b=2#section1

// Or using the URL builder.
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
echo PHP_EOL . $url->toAsciiString(); // https://user:pass@example.com:8080/foo/bar?a=1&b=2#section1

// Validation as expected.
//$uriBuilder = new Uri\Rfc3986\UriBuilder()
//    ->setScheme("http%80"); // Fatal error:  Uncaught Uri\InvalidUriException: The specified scheme is malformed.
//$uriBuilder = new Uri\Rfc3986\UriBuilder()
//    ->setScheme("https")
//    ->setUserInfo("user:pass");
//$uriBuilder->build(); // Fatal error:  Uncaught Uri\InvalidUriException: Cannot set a userinfo without having a host.


// Uri type detection.
$uri = new Uri\Rfc3986\Uri("https://example.com"); // Uri\Rfc3986\UriType::Uri
$uri = new Uri\Rfc3986\Uri("/foo"); // Uri\Rfc3986\UriType::AbsolutePathReference
$uri = new Uri\Rfc3986\Uri("foo"); // Uri\Rfc3986\UriType::RelativePathReference
$uri = new Uri\Rfc3986\Uri("//host.com/foo"); // Uri\Rfc3986\UriType::NetworkPathReference
$uri->getUriType();

// https://url.spec.whatwg.org/#is-special
$url = new Uri\WhatWg\Url("https://example.com");
$url = new Uri\WhatWg\Url("custom:example");
$url->isSpecialScheme(); // Returns a bool.

// Percent-Encoding Support
// https://wiki.php.net/rfc/uri_followup#percent-encoding_support
echo PHP_EOL . rawurlencode("/foo/bar/baz");

// Host Type Detection
$uri = new Uri\Rfc3986\Uri("https://192.168.0.1/"); // UriHostType::IpV4
print_r($uri->getHostType());
$uri = new Uri\Rfc3986\Uri("https://[2001:db8::1]/"); // UriHostType::IpV6
$uri = new Uri\Rfc3986\Uri("https://[v1.1.2.3]/"); // UriHostType::IpVFuture
$uri = new Uri\Rfc3986\Uri("https://example.com/"); // UriHostType::RegisteredName
$uri = new Uri\Rfc3986\Uri("file:///C:/a.txt"); // null
$uri = new Uri\Rfc3986\Uri("foo:bar/baz"); // null
$uri = new Uri\Rfc3986\Uri("/foo/bar"); // null
$uri = new Uri\Rfc3986\Uri("mailto:john.doe@example.com"); // null
