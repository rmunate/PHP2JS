---
title: Release Notes
editLink: true
outline: deep
---

# Release Notes

## [5.0.0]

### Changed

- PHP2JS now requires Laravel 13 and PHP 8.3 or later in the PHP 8.x series. The `toJS()` and `toStrictJS()` APIs are unchanged.

### Fixed

- Alias validation no longer emits a PHP deprecation warning when rendering a view.

## [4.0.0] - 2023-11-10

### Changed

- **Property `vars`**: In previous versions, it was used to access variables returned from PHP; now it has been replaced with `data`. For example: `PHP2JS.data.value`

- **Object Passed to JavaScript**: In previous versions, it was possible to create more than one object from PHP in JavaScript, which does not guarantee a good Server-Side Rendering (SSR) practice. The current version ensures that values are passed to JavaScript only once, and this is the only object to be manipulated from this context.

- **Compatibility**: The source code has been rewritten to be compatible with PHP 7.4 or higher and Laravel Framework versions 8.0 or higher.

- **Source Code**: The source code of this package has been rewritten by more than 90%, so it does not have support for previous versions. Efforts were made to improve performance, security, and the coherence of each class.

### Removed

- **Blade Directives**: Blade directives have been removed since, if not used with a different alias in each, they conflict with each other. Now, data sharing with JavaScript will only be handled from controllers. Suppressed Directives:

    > @PHP2JS_VARS()

    > @PHP2JS_VARS_STRICT(['variable1','variable2'])

    > @PHP2JS_AGENT()

    > @PHP2JS_URL()

    > @PHP2JS_CSRF()

    > @PHP2JS_FRAMEWORK()

    > @PHP2JS_PHP()

    > @PHP2JS_USER()

- **Artisan Command**: Since rendering Blade directives is not required, the `php2js:clear` command has been removed.

- **Method `attach`**: As the use of pre-built blocks is not a generality and may not always meet the specific needs of an application, the functionality to share values with JavaScript has been removed, leaving it to the developer's discretion.

- **Unused JavaScript Methods**: All methods lacking real use of the resulting object when sharing data from PHP2JS with JavaScript have been removed. Suppressed Methods:

    > .clear()

    > .clearWithoutFunctions();

    > .assignAndClear()

    > .assignAndClearWithoutFunctions()

    > .onlyFunctions()

    > .exceptFunctions()

    > .getAllProperties()

    > .getAllProperties()

## [4.3.0] - 2023-12-10

- Adjusted PHPStan static code analysis configuration, refined source code for improved readability and consistency.

## [4.5.0] - 2024-05-20

- Adjusted to be compatible with Laravel 11