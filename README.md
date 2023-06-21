# PHP2JS  (LARAVEL PHP Framework) v3.0.0

![logo](https://user-images.githubusercontent.com/91748598/236917119-68ae265f-56b4-433e-a0f4-4379c2e93e99.png)

## A new and secure way to share variables between Blade views and JavaScript files.

All imports you use with the following syntax `<script src="{{ asset('..............js') }}"></script>` or the `<script> ... </script>` tags you create directly in the view, after invoking any method of this library, will have access to the variables returned from the controller. You can separate the JavaScript logic from your Blade views without the need to make queries or requests to the server to retrieve the existing information on the front end.

- Define from the controller if the returned variables will be shared at the JavaScript level.
- Handle an identical syntax to the one provided by the framework to return views.
- Define whether useful data blocks will be added for manipulations and management on the front end using JavaScript programming.
- Generate files with unique and non-consecutive identities to prevent any type of code inspection.
- Define the entry alias for the values returned by the controller, thus avoiding the use of a generic identifier that can be accessed by the console or other means.
- Same functionality from Blade directives as from returning views from the controller.
- Obtain a set of data that will facilitate work in our applications.
- Identify where I connect from and manipulate this data from JS, defining the behavior of the application, whether it is mobile or desktop.
- Know the versions of the systems in use.
- Have the BaseUrl handy for server requests.
- Retrieve user data in session to enhance the experience from JS.
- Determine the browser, its version, and the platform being used.

## Installation

```console
composer require rmunate/php2js
```

Make sure you have the library in the latest version in your `composer.json`. `"rmunate/php2js": "^3.0"`

## Library functionalities from controllers.

You will have the facility to return your views, defining whether you will share your variables with JavaScript through four possible methods.

```php
use Rmunate\Php2Js\Render;

/* Using Compact */
return Render::view('welcome', compact('variable1', 'variable2', 'variable3', '...'))->toJS()->compose();

/* Using With */
return Render::view('welcome')->with(compact('variable1', 'variable2', 'variable3', '...'))->toJS()->compose();

/* Same method but with an associative array */
return Render::view('welcome')->with([
    'variable1' => $variable1,
    ...
])->toJS()->compose();
```

In the previous examples, if you notice, it is the same syntax you always use in the current framework. However, you will have two new methods. From these two new methods, the following table shows the uses regarding sending variables to JavaScript. The `->compose()` method should always go at the end. If you wish, you can return the view without sharing data by simply nesting the method `Render::view('view_name')->compose()` or `Render::view('view_name', compact('var...'))->compose()`.

| METHOD | DESCRIPTION | RETURN |
| ------ | ------ | ------ |
| `->toJS(string $Obj='PHP')` | This method is recommended by the creators of this functionality. It allows JavaScript to access all the variables returned from the controller, as well as the URL data in use and the use of a valid Laravel token. | { vars: { ... }, url: { ... }, csrf: { ... } } |
| `->toAllJS(string $Obj='PHP')` | This method returns all the data that has been determined as useful for working with JavaScript using the data returned from the controller. It provides a large amount of data that can be used to improve the performance and customization of our application as needed. | { vars: { ... }, url: { ... }, csrf: { ... }, php: { ... }, laravel: { ... }, user: { ... }, agent: { ... } } |
| `->toStrictJS(string $Obj='PHP')` | This method exclusively returns the information of the variables returned by the controller and does not return any additional values. | { vars: { ... } } |
| `->toJSWith(array $grp = [], string $Obj='PHP')` | If you want to define what information to share with JavaScript in addition to the variables returned by the controller, this method receives an array as the first parameter where you can enter any of the following options: `[url, csrf, php, laravel, user, agent]` for the prepared values to be used, which will be shared with JavaScript. | { vars: { ... }, [... ] } |

By default, in JavaScript, to access these returned values, you will use the constant PHP.

```javascript
PHP.vars.myVariable
```

However, from the controller, you can assign a different name to this constant, which is recommended. You can do it in the controller as follows:

```php
use Rmunate\Php2Js\Render;

return Render::view('welcome', compact('myVariable'))->toJS('_PHP2JS')->compose();
```

You can read it in JS like this:

```javascript
_PHP2JS.vars.myVariable
```

Now, to continue with the standard of the previous versions of the library, you can also create a bridge between PHP Laravel and JavaScript from the views using Blade directives. In these cases, it will not be necessary to use the syntax of this library in the controller (although you can if you want since it is the same original functionality of the framework). You will have the following directives available at the moment.

| DIRECTIVE | DESCRIPTION | RETURN |
| ------ | ------ | ------ |
| `@toJS(string $Obj='PHP2JS')` | This directive is recommended by the creators of this functionality. It allows JavaScript to access all the variables returned from the controller and those created prior to instantiating the directive, as well as the URL data in use and the use of a valid Laravel token. | { vars: { ... }, url: { ... }, csrf: { ... } } |
| `@toAllJS(string $Obj='PHP2JS')` | This directive returns all the data that has been determined as useful for working with JavaScript using the data returned from the controller. It provides a large amount of data that can be used to improve the performance and customization of our application as needed. | { vars: { ... }, url: { ... }, csrf: { ... }, php: { ... }, laravel: { ... }, user: { ... }, agent: { ... } } |
| `@toStrictJS(string $Obj='PHP2JS')` | This directive exclusively returns the information of the variables returned by the controller and does not return any additional values. | { vars: { ... } } |

Remember that you can pass the alias you want to use for its calling from JavaScript as an argument.

**The values that are returned in general are as follows:**

```javascript
// ALIAS = By default PHP from controllers or PHP2JS from Blade directives

ALIAS = {
    vars: // Variables read from the Server,
    url: {
        baseUrl: // Base for server requests,
        fullUrl: // Full URL,
        uri: // Current URI according to Laravel routes,
        parameters: {
            route: // Parameters sent by route,
            get: // Parameters sent as URL query get,
            post: // Parameters sent with the POST method,
        },
        scheme: // HTTPx,
    },
    csrf: {
        token: // Valid Laravel token
    },
    php: {
        id: // Release Id,
        version: // PHP version in use,
        release: // Release in use
    },
    laravel: {
        version: // Laravel version in use,
        environment: {
            name: // Application name in env,
            debug: // True - False according to the env configuration,
        }
    },
    user: {
        // Non-sensitive user session data
    },
    agent: {
        identifier: // Complete agent value,
        remote_ip: // IP from where the application is consumed,
        remote_port: // Remote IP port from where the application is consumed,
        browser: {
            // Browser values
        },
        isMobile: //Know if it is a connection from mobile devices
        OS: // Operating system of the person connecting
    }
}
```

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
