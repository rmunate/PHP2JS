# PHP2JS (LARAVEL PHP Framework) v3.x

![logo](https://user-images.githubusercontent.com/91748598/236917119-68ae265f-56b4-433e-a0f4-4379c2e93e99.png)

## A new and secure way to share variables between Blade views and JavaScript files.

All imports you use with the following syntax `<script src="{{ asset('..............js') }}"></script>` or the `<script> ... </script>` tags you create directly in the view, after invoking any method of this library, will have access to the variables or data blocks you have defined from the controller or Blade directive. You can separate the JavaScript logic from your Blade views without the need to make server queries or requests to obtain the existing information on the front-end.

- Define from the controller whether the returned variables will be shared at the JavaScript level.
- Handle a syntax similar to the one provided by the framework to return views.
- Define whether useful data blocks will be added for manipulations and operations on the front-end using JavaScript.
- Define the input alias for the values returned by the controller, thus avoiding the use of a generic identifier that can be accessed through the console or other methods **Recommended**.
- Same functionalities from Blade directives as from returning views from the controller.
- Obtain a set of data that will facilitate work in our applications.
- Identify where I connect from and manipulate this data from JS, defining the behavior of the application, knowing if it is mobile or desktop.
- Know the versions of the systems in use.
- Have the BaseUrl at hand for server requests.
- Retrieve user session data to enhance the experience from JS.
- Identify the browser, its version, and the platform being used.
- Know the IP from which the application is accessed.
- This is a very brief description of the features provided by this library.


## _Installation_

```console
composer require rmunate/php2js
```

Make sure you have the library in the latest version in your `composer.json`. `"rmunate/php2js": "^3.5"`

## Library Functionality from Controllers
You will have the ease of returning your views while defining if you want to share your variables with JavaScript through different methods.

### Return a view without sharing data with JavaScript
```php

// Import Library Usage
use Rmunate\Php2Js\Render;

// 1 - Using only the "view" method with "compact"
return Render::view('welcome', compact('variable',...))->compose();

// 2 - Using only the "view" method without "compact"
return Render::view('welcome', ['name' => $value])->compose();

// 3 - Using the "view" method, the "with" method, and "compact"
return Render::view('welcome')->with(compact('variable',...))->compose();

// 4 - Using the "view" method, the "with" method without "compact"
return Render::view('welcome')->with(['name' => $value])->compose();

```

### Return a view sharing all variables returned by the controller with JavaScript

The syntax will be the same as the previous view, but we will add some new methods that will facilitate sharing variables with JavaScript.

```php

// Import Library Usage
use Rmunate\Php2Js\Render;

// The "toJS()" method will share all variables returned to the view with JavaScript, now you will have the "PHP2JS" constant available in JS
return Render::view('welcome')->with(['name' => $value])->toJS()->compose();

// If you want to use a different constant name (RECOMMENDED), you can do it as shown below, where we will use "MyAlias" as the constant name
return Render::view('welcome')->with(['name' => $value])->toJS('MyAlias')->compose();

```

### Return a view sharing only the desired variables with JavaScript

```php

// Import Library Usage
use Rmunate\Php2Js\Render;

// The "toStrictJS()" method will only share the desired variables with JavaScript, now you will have the "PHP2JS" constant available in JS with these values.

$variable1 = 'Example Variable 1';
$variable2 = 'Example Variable 2';

// Using Compact
return Render::view('pages.guest.index')->toStrictJS(compact('variable1'))->compose();

// Without using Compact
return Render::view('pages.guest.index')->toStrictJS(['variable1' => $variable1])->compose();

// Return different values to the view and JavaScript
return Render::view('pages.guest.index')->with(['variable1' => $variable1])->toStrictJS(['variable2' => $variable2])->compose();

// Use a custom constant name for the input values in JavaScript
return Render::view('pages.guest.index')->toStrictJS(['variable1' => $variable1],'MyAlias')->compose();

```

### Return a view sharing variables and useful information blocks with JavaScript

```php

// Import Library Usage
use Rmunate\Php2Js\Render;

// The "attach()" method will share, in addition to the variables, information blocks that will help you in your JavaScript files.

// With the "attach()" method, you can pass one or several identifiers of the available blocks in the current version of the library.

return Render::view('pages.guest.index')->with(['variable1' => $variable1])->toJS()->attach('agent','url','csrf','framework','php','user')->compose();

return Render::view('pages.guest.index')->toStrictJS(['variable1' => $variable1])->attach('agent','url','csrf','framework','php','user')->compose();

```

In the previous examples, you may have noticed that the syntax used is the same as in the current framework. However, there are new methods available. These methods should always be placed before the final `->compose()` method.

The additional information blocks include:

| BLOCK | DATA |
| ------ | ------ |
| `agent` | agent: {identifier, remote_ip, remote_port, browser, isMobile, OS} You can find out the device from which the connection is made, the browser being used, if it is a connection from a mobile device, the source IP address of the connection, and the port in use. |
| `url` | url: {baseUrl, fullUrl, uri, scheme, parameters: {route, get, post}} You can retrieve the information about the current URL, the passed parameters, the URI, the base URL for server requests, and more. |
| `csrf` | Returns a valid token for JavaScript requests, allowing you to make AJAX requests, for example, by including the token in the payload. |
| `framework` | framework: {version, environment: {name, debug}} Returns information about the framework being used, such as the version and non-sensitive values from the ENV. |
| `php` | php: {id, version, release} Returns information about the PHP version being used. |
| `user` | user: {...} Returns the information of the user in session, with the ID encrypted to avoid displaying sensitive information. It does not return data such as passwords or timestamps. |

By default, in JavaScript, to access these returned values, you will use the PHP2JS constant. If you assigned a specific name, as recommended, you should access the values through that name.

```javascript
PHP2JS.vars.variables;
//or
ALIAS.vars.variables;
```

## Blade Directives

```php
//-------------------
//All directives allow you to assign an Alias to the input constant in JS
//-------------------

//Share the connection agent information.
@PHP2JS_AGENT() // @PHP2JS_AGENT('MyAlias')

//Share the current URL information.
@PHP2JS_URL() // @PHP2JS_URL('MyAlias')

//Share a valid Laravel CSRF token.
@PHP2JS_CSRF() // @PHP2JS_CSRF('MyAlias')

//Share non-sensitive Laravel framework information.
@PHP2JS_FRAMEWORK() // @PHP2JS_FRAMEWORK('MyAlias')

//Share non-sensitive PHP information.
@PHP2JS_PHP() // @PHP2JS_PHP('MyAlias')

//Share non-sensitive user session information.
@PHP2JS_USER() // @PHP2JS_USER('MyAlias')

//Share with JavaScript all variables defined or returned by the controller. If additional variables have been defined from the view, they will also be shared with JavaScript.
@PHP2JS_VARS() // @PHP2JS_VARS('MyAlias')

//Share only the desired variables with JavaScript. Only the variable names should be included in an array, as shown below.
@PHP2JS_VARS_STRICT(['variable1', 'variable2']) // @PHP2JS_VARS_STRICT(['variable1', 'variable2'], 'MyAlias')

```

## Structure of the Complete Object

```javascript

{ALIAS} = {
    vars: //Variables read from the server,
    url: {
        baseUrl: //Base URL for server requests,
        fullUrl: //Current full URL,
        uri: //Current URI according to Laravel routes,
        parameters: {
            route: //Parameters sent through routes,
            get: //Parameters sent as GET query through the URL,
            post: //Parameters sent with the POST method,
        },
        scheme: //HTTPx,
    },
    token: //Valid Laravel token,
    php: {
        id: //ID Release,
        version: //PHP version in use,
        release: //Release in use
    },
    laravel: {
        version: //Laravel version in use,
        environment: {
            name: //Application name in the env,
            debug: //True or False according to the env configuration,
        }
    },
    user: {
        // Non-sensitive user session data
    },
    agent: {
        identifier: //Complete agent value,
        remote_ip: //IP address from where the application is accessed,
        remote_port: //Port of the remote IP from where the application is accessed,
        browser: {
            //Browser values
        },
        OS: //Operating system of the user connecting
    }
}
```

> **Important!** _Remember that the library always returns the same variable, so you should avoid having issues trying to redefine the same value when using the directives from multiple places._

## Creator
- 🇨🇴 Raúl Mauricio Uñate Castro. (raulmauriciounate@gmail.com)

## Contributing Developers
- 🇨🇴 Carlos Giovanni Rodriguez (musica_tuto@hotmail.com)
- 🇨🇴 Laura Valentina Borda Vargas (lvalentina0507@gmail.com)
- 🇨🇴 Wilmer A. Sanchez Saez (wilmersaz@hotmail.com)
- 🇨🇴 John Alejandro Diaz Pinilla (diazjohn83@gmail.com)
- 🇨🇴 Jorge Hernan Castañeda (ds.jorgecastaneda@gmail.com)
- 🇲🇽 Julio C. Borges (julio-borgeslopez@outlook.com)

[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)

This structure represents the complete object that is shared with JavaScript. It contains various sections such as variables, URL information, token, PHP and Laravel details, user session data, and agent information. You can access this object using the assigned alias or the default constant `PHP2JS`.

Please note that this information was provided based on the given code and documentation. If there are any specific implementation details or changes in the library, it's recommended to refer to the library's official documentation or reach out to the library's creator for the most accurate and up-to-date information.