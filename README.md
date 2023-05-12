# PHP2JS (LARAVEL) V2.6.1

![logo](https://user-images.githubusercontent.com/91748598/236917119-68ae265f-56b4-433e-a0f4-4379c2e93e99.png)

## Read variables returned from the controller and defined in the Blade view into external JavaScript files, perfect library for Blade monoliths.
All the imports that you use in the following way, after invoking this library will have access to the PHP variables, easy and very useful.
`<script src="{{ asset('..............js') }}"></script>`

Read PHP variables in external JavaScript files without needing to make unnecessary AJAX, FETCH or AXIOS requests, use the same variables returned by the controller or created in the view before invoking the library, as well as some additional values that will simplify your I work enormously.

- Read all variables returned by the controller in external JavaScript files to maintain a clean code structure.
- Read all variables declared in the Blade view, from external JavaScript files.
- Obtain the information of the URL in use, the protocol, the URI, the parameters, etc.
- Obtain the information of the PHP version in USO. Version, ID, etc.
- Obtain the data of the Agent, Remote IP address from where the system is entered, port in use, Operating System, etc.
- Get a valid CSRF token anywhere in your JavaScript.
- Obtain the relevant data of the User in session, protecting the ID with the Laravel Helper Crypt::encrypt($id).

## _Installation via Composer_

```console
composer require rmunate/php2js
```

Make sure that in `composer.json` you have the library at its latest version. `"rmunate/php2js": "^2.6"`

Introduce the Provider in the config\app.php file. (Laravel 8 or Lower)
```php
'providers' => [
    //..
    Rmunate\Php2Js\PHP2JSServiceProvider::class,
],
```

## Use
In the view, before calling the external JavaScript files, you must place the `@__PHP()` directive, it must be there only once.
This will make all variables returned by the server and declared in the view readable in all JavaScript files entered in the following lines of code.

```php
@__PHP()
<script src="{{ asset('js/myscript.js') }}"></script>
```

## Methods
Invoke the method you require or call the constant anywhere in your JavaScript code.

| METHOD | CONSTANT | DESCRIPTION |
| ------ | ------ | ------ |
| `__PHP().groups()` | `$PHP_GROUPS` | Devuelve un objeto con grupos de las variables disponibles **Recomendado**. |
| `__PHP().all()` | `$PHP` | Returns an object with all the information at a single level. |
| `__PHP().vars()` | `$PHP_VARS` | Returns exclusively the variables defined in PHP in an object, omitting the others. |
| `__PHP().baseUrl()` | `$PHP_BASE_URL` | Returns the base URL of the System for Ajax, Axios, Fetch or similar requests. |
| `__PHP().fullUrl()` | `$PHP_FULL_URL` | Returns the full URL with its parameters. |
| `__PHP().parameters()` | `$PHP_PARAMETERS` | Returns the parameters of the URL. |
| `__PHP().uri()` | `$PHP_URI` | Returns the URI according to the Laravel Routes. |
| `__PHP().scheme()` | `$PHP_SCHEME` | Returns the scheme in use HTTP or HTTPS. |
| `__PHP().token()` | `$PHP_TOKEN` | Returns a CSRF TOKEN. |
| `__PHP().tokenMeta()` | `$PHP_TOKEN_META` | Returns a meta tag with the CSRF TOKEN. |
| `__PHP().tokenInput()` | `$PHP_TOKEN_INPUT` | Returns a hidden input with the CSRF TOKEN. |
| `__PHP().php_version()` | `$PHP_VERSION` | Returns the current version of PHP. |
| `__PHP().php_id()` | `$PHP_ID` | Returns the ID of the current version of PHP. |
| `__PHP().php_release()` | `$PHP_RELEASE` | Returns the Release of the current version of PHP. |
| `__PHP().agent()` | `$PHP_AGENT` | Returns the value of the Agent in connection. (Browser, device, Operating System, etc). |
| `__PHP().remote_ip()` | `$PHP_AGENT_REMOTE_IP` | Returns the IP address from where the system is being consumed. |
| `__PHP().remote_port()` | `$PHP_AGENT_REMOTE_PORT` | Returns the port in use from where the system is being consumed. |
| `__PHP().browser()` | `$PHP_AGENT_BROWSER` | Returns the details of the browser in use. |
| `__PHP().is_mobile()` | `$PHP_AGENT_IS_MOBILE` | Returns TRUE if you are connected to the system from a mobile device. |
| `__PHP().mobile_os_android()` | `$PHP_AGENT_MOBILE_OS_ANDROID` | Returns TRUE if you are connected to the system from an Android. |
| `__PHP().mobile_os_iphone()` | `$PHP_AGENT_MOBILE_OS_IPHONE` | Returns TRUE if you are connected to the system from an IPHONE. |
| `__PHP().os_linux()` | `$PHP_AGENT_OS_LINUX` | Returns TRUE if you are connected to the system from a LINUX OS. |
| `__PHP().os_ios()` | `$PHP_AGENT_OS_IOS` | Returns TRUE if you are connected to the system from an OS IOS MAC. |
| `__PHP().os_windows()` | `$PHP_AGENT_OS_WINDOWS` | Returns TRUE if you are connected to the system from Windows. |
| `__PHP().user()` | `$PHP_USER` | Returns the information of the user in session with the encrypted ID. |
| `__PHP().debug()` | `$PHP_DEBUG` | Returns the state of the APP_DEBUG variable from the Laravel ENV. |

```javascript

/* This will return an object with all the values available from the server. */
__PHP().all()
// {
//     "vars": {
//         //..Variables Returned by the backend
//     },
//     "baseUrl": "http://127.0.0.1:8000",
//     "fullUrl": "http://127.0.0.1:8000/branches/branch404",
//     "parameters": {
//         "id": "branch404"
//     },
//     "uri": "branches/{id}",
//     "token": "4HEsdym.............",
//     "tokenMeta": "<meta name=\" csrf-token\" content=\"4HEsdym.............">",
//     "tokenInput": "<input type\"hidden\" name=\"_token\" value=\"4HEsdym............."/>",
//     "user": {
//         "id": y2asdas2......,
//         "name": ".....",
//         "username": ".....",
//         "email": "....."
//     }
//     // ...
// }

/* Read all PHP variables from JavaScript with this method. */
__PHP().groups() //Access by method
$PHP_GROUPS      //access by constant

/* Step directly into a variable returned by the controller */
__PHP().vars().ejemplo //Equals the variable $ejemplo.
$PHP_VARS.ejemplo      //Equals the variable $ejemplo.

/* Call base url for requests to the server */
 $.ajax({ url: __PHP().baseUrl() + '/generador/ciudades/', ...
 $.ajax({ url: $PHP_BASE_URL + '/generador/ciudades/', ...


/* Peticiones que requieran token */
"ajax": {
    "url": __PHP().baseUrl() + "/route", //$PHP_BASE_URL + "/route"
    "data":{
        _token : __PHP().token() //$PHP_TOKEN 
        data : {
            //Data
        }
    }
},

/* Generation of a Valid Token */
__PHP().token() //"4HEsdy.........."
$PHP_TOKEN      //"4HEsdy.........."
```
## Creator
- 🇨🇴 Raúl Mauricio Uñate Castro. (raulmauriciounate@gmail.com)

## Contributing Developers
- 🇨🇴 Wirmer A. Sanchez Saez (wilmersaz@hotmail.com)
- 🇨🇴 Jorge Hernan Castañeda (ds.jorgecastaneda@gmail.com)
- 🇲🇽 Julio C. Borges (julio-borgeslopez@outlook.com)


[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)
