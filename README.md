# PHP2JS (The Library that Made Handling Monoliths in Laravel Simple) (LARAVEL PHP Framework) v3.x
⚙️ This library is compatible with Laravel versions 9.0 and above ⚙️

[![Laravel 9.0+](https://img.shields.io/badge/Laravel-9.0%2B-orange.svg)](https://laravel.com)
[![Laravel 10.0+](https://img.shields.io/badge/Laravel-10.0%2B-orange.svg)](https://laravel.com)

![logo](https://user-images.githubusercontent.com/91748598/236917119-68ae265f-56b4-433e-a0f4-4379c2e93e99.png)
[**---- Documentación En Español ----**](README_SPANISH.md)

# Table of Contents
1. [Introduction](#introduction)
2. [Installation](#installation)
3. [Usage](#usage)
   1. [Laravel Controllers](#laravel-controllers)
      1. [Returning Conventional View](#returning-conventional-view)
      2. [Returning View Sharing Variables With JavaScript](#returning-view-sharing-variables-with-javascript)
      3. [Returning View Sharing Only Specific Variables With JavaScript](#returning-view-sharing-only-specific-variables-with-javascript)
      4. [Returning View Sharing Prebuilt Blocks With JavaScript](#returning-view-sharing-prebuilt-blocks-with-javascript)
   2. [Blade Directives](#blade-directives)
      1. [Share Connection Agent Data](#share-connection-agent-data)
      2. [Share URL Data](#share-url-data)
      3. [Share Valid CSRF Token](#share-valid-csrf-token)
      4. [Share Framework Information](#share-framework-information)
      5. [Share PHP Information](#share-php-information)
      6. [Share User Session Information](#share-user-session-information)
      7. [Share Existing PHP Variables With JavaScript](#share-existing-php-variables-with-javascript)
      8. [Share Only Some Existing PHP Variables With JavaScript](#share-only-some-existing-php-variables-with-javascript)
   3. [JavaScript Methods](#javascript-methods)
      1. [Clear](#clear)
      2. [Clear Without Functions](#clear-without-functions)
      3. [Assign](#assign)
      4. [Assign and Clear](#assign-and-clear)
      5. [Assign and Clear Without Functions](#assign-and-clear-without-functions)
      6. [Only](#only)
      7. [Only Functions](#only-functions)
      8. [Except](#except)
      9. [Except Functions](#except-functions)
      10. [Check Property Existence (hasProperty)](#check-property-existence-hasproperty)
      11. [Get All Properties](#get-all-properties)
      12. [Set](#set)
      13. [Get](#get)
4. [Creator](#creator)
5. [Contributors](#contributors)
6. [License](#license)

## Introduction

The PHP2JS library provides various valuable features for working with JavaScript and Laravel:

1. **Access to Shared Data**: Variables or data blocks defined from the controller or Blade directives are available in JavaScript imports, allowing separation of JavaScript logic from Blade views without making additional queries to the server.
2. **Definition of Shared Variables**: Developers can choose whether the returned variables will be shared at the JavaScript level, providing flexibility in handling data between the backend and frontend.
3. **Laravel-Like Syntax**: The library uses a syntax similar to Laravel's for returning views, making it easy to use and reducing the learning curve for developers familiar with Laravel.
4. **Useful Data Blocks**: Useful data blocks for manipulations and management on the frontend allow access to a set of data that facilitates work in applications.
5. **Custom Alias**: Developers can define an alias for the values returned by the controller, improving security and avoiding the use of generic identifiers that may be accessible from the console or other methods.
6. **Functionalities From Blade and Controller**: The same functionalities are available from both Blade directives and view returns from the controller, providing a consistent experience for developers.
7. **User Information**: The library provides useful information about the user, such as device type, system version, browser, and IP, enabling customization of the user experience from JavaScript.
8. **Multiple Useful Methods**: The multiple useful methods in JavaScript facilitate the treatment of information delivered by PHP Laravel, improving development efficiency and productivity.

In summary, the PHP2JS library offers a set of powerful features that simplify communication between Laravel's backend and JavaScript's frontend, making it easier to create efficient and personalized web applications.

## Installation
To install the dependency via Composer, run the following command:

```console
composer require rmunate/php2js
```

Make sure that in the `composer.json` file, you have the library in the latest version. `"rmunate/php2js": "^3.8"`
Always after installing, run the following commands:
```console
php artisan cache:clear; php artisan view:clear; php artisan config:clear
```

## Usage
The library offers various ways of use, both from Laravel controllers and from views through simple Blade directives. 
We tried to make it as simple as possible for you to quickly familiarize yourself with its usage.

## Laravel Controllers
Below is the usage from Laravel controllers.

### Returning Conventional View
The following code shows how to return a view conventionally, without sharing data with JS, but leaving an instance of the library ready in case you need to share data with JavaScript in the future.

```php
// Import Library Usage
use Rmunate\Php2Js\Render;

// 1 - Using only the "view" method with "compact"
return Render::view('welcome', compact('variable', ...))->compose();

// 2 - Using only the "view" method without "compact"
return Render::view('welcome', ['name' => $value])->compose();

// 3 - Using the "view" method, the "with" method, and "compact"
return Render::view('welcome')->with(compact('variable', ...))->compose();

// 4 - Using the "view" method, the "with" method without "compact"
return Render::view('welcome')->with(['name' => $value])->compose();
```

### Returning View Sharing Variables With JavaScript
The syntax will be the same as shown above, with some new methods added to make it easier to share variables with JavaScript. In this scenario, we will use the `->toJS()` method, which shares 100% of the returned variables with JavaScript. It is always recommended to assign a custom alias to deliver the values to JavaScript.

```php
// Import Library Usage
use Rmunate\Php2Js\Render;

// The "toJS()" method will share all the variables returned to the view with JavaScript, and now you will have the constant "PHP2JS" available in JS.
return Render::view('welcome')->with(['name' => $value])->toJS()->compose();

// If you want to use a different constant name **RECOMMENDED**, you can do it as shown below, where we use "MyAlias" as the constant name.
return Render::view('welcome')->with(['name' => $value])->toJS('MyAlias')->compose();
```

### Returning View Sharing Only Specific Variables With JavaScript
If you have cases where you only want to share some variables with JavaScript, you can do it freely. Furthermore, if you want to share different values between the Blade View and JavaScript, you can also do that. The `->toStrictJS()` method allows us to do this. It is always recommended to assign a custom alias to deliver the values to JavaScript.

```php
// Import Library Usage
use Rmunate\Php2Js\Render;

// The "toStrictJS()" method will only share the desired variables with JavaScript, and now you will have the constant "PHP2JS" available in JS with these values.

$variable1 = 'Example Of Variable 1';
$variable2 = 'Example Of Variable 2';

// Using Compact
return Render::view('pages.guest.index')->toStrictJS(compact('variable1'))->compose();

// Without Using Compact
return Render::view('pages.guest.index')->toStrictJS(['variable1' => $variable1])->compose();

// Returning different values to the view and JavaScript
return Render::view('pages.guest.index')->with(['variable1' => $variable1])->toStrictJS(['variable2' => $variable2])->compose();

// Use a custom constant name as the input to JavaScript values **RECOMMENDED**
return Render::view('pages.guest.index')->toStrictJS(['variable1' => $variable1], 'MyAlias')->compose();
```

### Returning View Sharing Prebuilt Blocks With JavaScript
PHP2JS comes with some prebuilt data blocks that we believe will add value in certain types of development. We have provided certain blocks that we will show in this section, which you can attach to the view return to share them with JavaScript. The `->attach()` method provides the functionality to add these data blocks to the view return. You can use this method after the `->toJS()` or `->toStrictJS()` methods, as shown in the example. It is always recommended to assign a custom alias to deliver the values to JavaScript.

```php
// Import Library Usage
use Rmunate\Php2Js\Render;

// The "attach()" method will additionally share variables, as well as data blocks that will be useful for your work in JavaScript files.
// You can send one or more identifiers of the blocks available in the current version of the library to the "attach()" method.

// Using the toJS method
return Render::view('pages.guest.index')->with(['variable1' => $variable1])->toJS('MyAlias')->attach('agent', 'url', 'csrf', 'framework', 'php', 'user')->compose();

// Using the toStrictJS method
return Render::view('pages.guest.index')->toStrictJS(['variable1' => $variable1], 'MyAlias')->attach('agent', 'url', 'csrf', 'framework', 'php', 'user')->compose();
```

### Contents of the Prebuilt Blocks

| BLOCK | DATA |
| ------ | ----- |
| `agent` | `agent: {identifier, remote_ip, remote_port, browser, isMobile, OS}`<br>You can know from which device the connection is executed, the browser in use, if it is a connection from a mobile device, the source IP address of the connection, and the port. |
| `url` | `url: {baseUrl, fullUrl, uri, scheme, parameters: {route, get, post}}`<br>You can know the data of the current URL, the passed parameters, the URI, the base URL for server requests, etc. |
| `csrf` | `csrf: {token, tokenCookie}`<br>Returns a valid token for requests from JavaScript, allowing AJAX requests by adding the token to the payload. |
| `framework` | `framework: {version, environment: {name, debug, context, url}}`<br>Returns information about the framework in use, such as the version and non-sensitive ENV values. |
| `php` | `php: {id, version, release, serverSoftware, serverOperatingSystem, extensions, clientLanguage}`<br>Returns information about the PHP version in use and server details. |
| `user` | `user: {...}`<br>Returns information about the user in session. The ID is encrypted to avoid displaying sensitive information, and sensitive data such as passwords and timestamps are not included. |

### How to Access From JavaScript?
Now that you know how to return values from the controllers and share them with JavaScript, we show you how you can access them. Remember that if you used a custom alias as we suggested, this alias will become a constant within the JavaScript environment. If you did not use an alias, the default constant created is `PHP2JS`, but it is always recommended to create a custom alias in each case.

```javascript
// You can use this syntax to access the variables anywhere in JavaScript.

// Without a custom alias
PHP2JS.vars.variables;

// With a custom alias **RECOMMENDED**
ALIAS.vars.variables;
```

## Blade Directives
If you prefer to share data with JavaScript from Blade instead of using the controller, you can use the library according to this section. Always remember that it is convenient to use a custom alias for each case. Additionally, if you use more than one directive, it will be necessary to use different aliases since constants cannot be rewritten or declared with the same name in the JS context.

### Share Connection Agent Data
This directive allows you to pass an object with the connection agent data captured by the server to JavaScript. No JS capture methods are used; all the data is read and passed by the server to JavaScript.

```php
// Without Alias
@PHP2JS_AGENT()

// With Alias **RECOMMENDED**
@PHP2JS_AGENT('MyAlias')
```

This will share the following data with JavaScript:
```javascript
PHP2JS = {
    agent: {
        identifier:   // Connection Agent Registered From Server (Not Registered By Frontend),
        remote_ip:    // Remote IP of the user's connection captured by the server,
        remote_port:  // Remote port of the user's connection captured by the server,
        browser:      // Browser data in use (Name, Version, and Platform),
        isMobile:     // True or False depending on whether the connection is from a mobile device.
        OS:           // Operating system used to connect to the application.
    }
}
```

### Share URL Data
This directive allows you to pass an object with the data of the current URL to JavaScript. The object will allow you to access the values similar to when you send a request to the server.

```php
// Without Alias
@PHP2JS_URL()

// With Alias **RECOMMENDED**
@PHP2JS_URL('MyAlias')
```

This will share the following data with JavaScript:
```javascript
PHP2JS = {
    url: {
        baseUrl:      // Base URL to be used for AJAX requests, Axios, Fetch, etc.,
        fullUrl:      // Complete URL being accessed, without clearing any queries it may have from the URL,
        uri:          // URI, the value that comes after the Domain name,
        parameters: {
            route:    // Parameters passed by the Laravel route (GET),
            get:      // Parameters sent through URL (Query) (GET),
            post:     // Parameters sent through (POST),
        },
        scheme:       // HTTP scheme in use.,
        currentName:  // Name of the Route Assigned From Laravel Routes,
        isSecure:     // Defines if it has SSL,
    }
}
```

### Share Valid CSRF Token
This directive is one of the most used and allows you to have a valid Laravel token at JavaScript runtime. The object will contain a valid token, just like the token delivered by the cookie from the server.

```php
// Without Alias
@PHP2JS_CSRF()

// With Alias **RECOMMENDED**
@PHP2JS_CSRF('MyAlias')
```

This will share the following data with JavaScript:
```javascript
PHP2JS = {
    token:          // Valid token for requests to the server by Laravel Request,
    tokenCookie:    // Token delivered by the server via Cookie,
}
```

### Share Framework Information
This directive allows you to know some data inherent to the Framework. It allows you to determine in many cases, as measured by its use, whether the application's debugger is active to perform some actions from JS. You may find more utilities for it.

```php
// Without Alias
@PHP2JS_FRAMEWORK()

// With Alias **RECOMMENDED**
@PHP2JS_FRAMEWORK('MyAlias')
```

This will share the following data with JavaScript:
```javascript
PHP2JS = {
    framework: {
        version:        // Version of Laravel in Use
        environment: {
            name:       // Application name from ENV
            debug:      // State of the application's debugger.
            context:    // Environment in which it is running according to ENV
            url:        // Application URL set in ENV
        }
    }
}
```

### Share PHP Information
This directive allows you to know some data inherent to the version of PHP in use. This directive can be used for systems where the use of multiple PHP versions is allowed. Only use it if you really have a use for it.

```php
// Without Alias
@PHP2JS_PHP()

// With Alias **RECOMMENDED**
@PHP2JS_PHP('MyAlias')
```

This will share the following data with JavaScript:
```javascript
PHP2JS = {
    php : {
        id:                     // PHP Version ID
        version:                // PHP version in use
        release:                // Current PHP release
        serverSoftware:         // Software of the web server running the current script
        serverOperatingSystem:  // Operating system on which PHP is running
        extensions:             // Enabled PHP extensions
        clientLanguage:         // Enabled client language
    }
}
```

### Share User Session Information
This directive allows you to share the data of the user in session with JavaScript. We thought of leaving it by default because all users of the platform use it; however, we prefer to leave it to your discretion. You will have the data of the user in session in JavaScript, don't worry! The user's ID in the database and sensitive information will not be displayed. The ID will be encrypted using Laravel's Crypt::encrypt() method.

```php
// Without Alias
@PHP2JS_USER()

// With Alias **RECOMMENDED**
@PHP2JS_USER('MyAlias')
```

This will share the following data with JavaScript:
```javascript
PHP2JS = {
    user : {
        id:                     // Encrypted ID
        email:                  // Email address
        ...                     // All other non-sensitive data.
    }
}
```

### Share Existing PHP Variables with JavaScript
The main directive of the library. It allows you to share all existing variables in PHP with JavaScript. This means that you will pass to JavaScript the values returned by the controller, as well as the values of the variables you have created in the Blade view. Yes! If you have defined loops and other statements in the Frontend, you will have all of this at your fingertips in JavaScript. This is really useful.

```php
// Without Alias
@PHP2JS_VARS()

// With Alias **RECOMMENDED**
@PHP2JS_VARS('MyAlias')
```

This will share the following data with JavaScript:
```javascript
PHP2JS = {
    ...:    // Well, any value can exist here; it depends on the existing variables in PHP
}
```

### Share Only Some Existing PHP Variables with JavaScript
The second main directive of the library. It allows you to share only some existing variables in PHP with JavaScript. This means that you will pass only the controlled values you need to JavaScript. This is more than useful; for sure, you can pass only some data, avoiding passing more values to JavaScript than necessary.

```php
// Without Alias
@PHP2JS_VARS_STRICT(['variable1','variable2'])

// With Alias **RECOMMENDED**
@PHP2JS_VARS_STRICT(['variable1','variable2'], 'MyAlias')
```

This will share the following data with JavaScript:
```javascript
PHP2JS = {
    ...:    // Well, any value can exist here; it depends on the existing variables you pass from PHP
}
```

## JavaScript Methods

In addition to having the data transmitted from PHP in the JavaScript environment, the object passed from PHP will offer you some methods that will be of great help. We are sure you will discover when to use each one on your own.

### Clear
The `.clear()` method will empty the object passed from PHP to JavaScript. This will be useful when you want the values not to be accessible from different object references.

```javascript
// Empty the object (All object references will lose their values)
// Remember to replace PHP2JS with the Alias you used.
PHP2JS.clear();
```

### Clear Without Functions
The `.clearWithoutFunctions()` method will empty the variables of the object passed from PHP to JavaScript. However, it will not remove the methods listed in this section. This will be useful when you want the values not to be accessible from different object references.

```javascript
// Empty the object (All object references will lose their values, but the functions will still exist)
// Remember to replace PHP2JS with the Alias you used.
PHP2JS.clearWithoutFunctions();
```

### Assign
The `.assign()` method assigns the same values from the Object passed by PHP to a new variable or constant. Now you can delete the original object without losing the values you leave in the new one. This will be useful when you want the values not to be accessible from different object references of the original object and instead use an object in JavaScript runtime.

```javascript
// Assign a copy of the object to a new variable at runtime.
// Remember to replace PHP2JS with the Alias you used.
const phpData = PHP2JS.assign();

// Here you could empty the original object.
PHP2JS.clear();

// The values will now be in "phpData"
```

### Assign and Clear
The `.assignAndClear()` method assigns the same values from the Object passed by PHP to a new variable or constant and additionally clears the original element. This will be useful when you want the values not to be accessible from different object references of the original object and instead use an object at JavaScript runtime.

```javascript
// Empty the object (All object references will lose their values, leaving a runtime copy inside another variable or constant)
// Remember to replace PHP2JS with the Alias you used.
const phpData = PHP2JS.assignAndClear();
// The values will now be in "phpData"
```

### Assign and Clear Without Functions
The `.assignAndClearWithoutFunctions()` method assigns the same values from the Object passed by PHP to a new variable or constant and additionally clears the values of the original element, but not the functions or methods. This will be useful when you want the values not to be accessible from different object references of the original object and instead use an object at JavaScript runtime.

```javascript
// Empty the object (All object references will lose their values without deleting the functions or methods.)
// Remember to replace PHP2JS with the Alias you used.
const phpData = PHP2JS.assignAndClearWithoutFunctions();
// The values will now be in "phpData" and the methods of the object will still exist in "PHP2JS".
```

### Only
The `.only(...props)` method allows you to extract information from the object passed by PHP with only the values you need. As parameters, you can define which values you really need. This will be useful when you don't want to load the entire content of the constant.

```javascript
// Get only the data passed as arguments in the Only method
// Remember to replace PHP2JS with the Alias you used.
const post = PHP2JS.only('post');
```

### Only Functions
The `.onlyFunctions()` method allows you to extract information about the functions present in the object passed by PHP to JavaScript.

```javascript
// Get only the methods or functions of the object passed by PHP to JavaScript.
// Remember to replace PHP2JS with the Alias you used.
const functions = PHP2JS.onlyFunctions();
```

### Except
The `.except(...props)` method allows you to extract information from the object passed by PHP with the values you don't want to consider. As parameters, you can define which values you do not want to load. This will be useful when you don't want to load the entire content of the constant.

```javascript
// Get only the data that is required while excluding others.
// Remember to replace PHP2JS with the Alias you used.
const withoutNews = PHP2JS.except('news');
```

### Except Functions
The `.exceptFunctions()` method allows you to extract information from the variables and pre-built code blocks except for the methods and functions.

```javascript
// Get only the values of the object passed by PHP to JavaScript.
// Remember to replace PHP2JS with the Alias you used.
const functions = PHP2JS.exceptFunctions();
```

### Check If Property Exists (hasProperty)
The `.hasProperty()` method allows you to determine if a property exists within the object. The return value will be true or false depending on the case.

```javascript
// Check if a property exists within the object.
// Remember to replace PHP2JS with the Alias you used.
const existPost = PHP2JS.hasProperty('post'); // true // false
```

### Get All Properties (getAllProperties)
The `.getAllProperties()` method allows you to obtain an array with all the properties of the object.

```javascript
// Get an array with all the properties of the object.
// Remember to replace PHP2JS with the Alias you used.
const existPost = PHP2JS.getAllProperties(); 
```

### Set
The `.set('prop','value')` method allows you to assign a new value to an existing property of the object. If you want to update, replace, or assign new values to a property of the object, you can easily do it.

```javascript
// In this example, we set the value of the "Account" property to 0;
// Remember to replace PHP2JS with the Alias you used.
PHP2JS.set("account", 0); 
```

### Get
The `.get('prop')` method allows you to obtain a specific property of the object. It returns only the requested property.

```javascript
// In this example, we will get only the value of "Account" within the object passed from PHP to JavaScript.
// Remember to replace PHP2JS with the Alias you used.
PHP2JS.get("account"); 
```

The power is at your fingertips. Much success in your projects!

## Creator
- 🇨🇴 Raúl Mauricio Uñate Castro
- Email: raulmauriciounate@gmail.com

## Contributors
- 🇨🇴 Carlos Giovanni Rodriguez (musica_tuto@hotmail.com)
- 🇨🇴 Laura Valentina Borda Vargas (lvalentina0507@gmail.com)
- 🇨🇴 Wilmer A. Sanchez Saez (wilmersaz@hotmail.com)
- 🇨🇴 John Alejandro Diaz Pinilla (diazjohn83@gmail.com)
- 🇨🇴 Jorge Hernan Castañeda (ds.jorgecastaneda@gmail.com)
- 🇲🇽 Julio C. Borges (julio-borgeslopez@outlook.com)

## License
[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)