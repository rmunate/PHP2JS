---
title: Release Notes
editLink: true
outline: deep
---

::: warning We strongly recommend migrating to the current version
If you have applications using previous versions, we highly recommend migrating to the current version. Keep in mind that the current version does not support functionalities from earlier versions. Its source code has been completely rewritten.
:::

# Release Notes

## [4.0.0] - 2023-11-10

### Added

- **QuickRequest**: Fetch request handler with event handling, installed alongside this package but can also be used independently.

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

## [4.1.0] - 2023-11-10

### Changed

- Adjusted the QuickRequest initializer to always return a new instance, allowing simultaneous use without causing conflicts. Previously: `QuickRequest.method()` Now: `QuickRequest().method()`

## [4.3.0] - 2023-12-10

- Adjusted PHPStan static code analysis configuration, refined source code for improved readability and consistency.