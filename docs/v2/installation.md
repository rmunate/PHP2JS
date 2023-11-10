---
outline: deep
title: Installation
---

# Installation

## Requirements

When you wish to use this solution, you must ensure the following:

**PHP:** Version equal to or higher than 7.4

## Installation

This package is available via Composer. You can install the latest stable version of the package by running the following command in your Laravel Framework project:

``` bash
composer require rmunate/php2js ^2.6
```

Make sure that in `composer.json` you have the library at the latest version. <Badge type="info" text='"rmunate/php2js": "^2.6"' />

```php
'providers' => [
    //..
    Rmunate\Php2Js\PHP2JSServiceProvider::class,
],
```