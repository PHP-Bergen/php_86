# What is improved in PHP 8.6

PHP 8.6 improve and extend more than simply adding new functions. No surprise in a mature language.

## Stream API

Swiss too used to everything from making HTTP requests to providing building blocks for async processing. Have a reputation to be also a huge mess. We get a lot of improvements that makes it more robust and helps enable future async processing features.

    * Improvements to Stream API's Error Handling
    * Performace improvments, TLS Session Resumption (TLS 1.3 with 0-RTT).

## Readonly Property Defaults (Type System)

Since PHP 8.1 introduced readonly properties and PHP 8.2 introduced readonly classes, immutable Data Transfer Objects (DTOs) and Domain Entities have become standard in modern PHP. Useful but they had one annoying limitation, you could not define default values for readonly properties in property declarations. 

* If you wanted a fixed value on a class, you used a class constant.

Then PHP 8.4 shipped interface properties, allowing you to write a contract that requires an instance property.

https://wiki.php.net/rfc/readonly_property_defaults

## Improvements for ext/uri - builder pattern

[Features intentionally left out](uri.md) of the initial proposal in PHP 8.5.

## PHP RFC: SNMP improvements for encryption protocols, mib reset, and controlling output

* https://github.com/net-snmp/net-snmp 
* https://www.net-snmp.org/ - https://github.com/net-snmp/net-snmp

### [> Index](./index.md)
