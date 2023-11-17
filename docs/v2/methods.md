---
title: Methods
editLink: true
outline: deep
---

## Methods
Invoke the method you require or call the constant anywhere in your JavaScript code.

| METHOD | CONSTANT | DESCRIPTION |
| ------ | ------ | ------ |
| `__PHP().groups()` | `$PHP_GROUPS` | Return a object with variables groups available **RECOMMENDED**. |
| `__PHP().all()` | `$PHP` | Returns an object with all the information at a single level. |
| `__PHP().vars()` | `$PHP_VARS` | Returns exclusively variables defined in PHP in an object, omitting the others. |
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

Examples
```javascript
// Read all PHP variables from JavaScript with this method.
$PHP_GROUPS         //Access by constant
__PHP().groups()    //Access by method

// Access all variables set in PHP
$PHP_VARS.ejemplo       //Like the variable $ejemplo.
__PHP().vars().ejemplo  //Like the variable $ejemplo.

// You can improve the performance in milliseconds if at the beginning of the script where you will use the PHP variables you save the data in a constant, as shown below
const _PHP = __PHP().vars(); 
//Now use this constant to access PHP variables, for other values ​​use the corresponding method provided by the library
```
Example of use in requests to the server
```javascript
// Call base url for requests to the server
 $.ajax({ url: $PHP_BASE_URL + '/generador/ciudades/', ...
 $.ajax({ url: __PHP().baseUrl() + '/generador/ciudades/', ...

// Requests that require token
"ajax": {
    "url": __PHP().baseUrl() + "/route",    //$PHP_BASE_URL + "/route"
    "data":{
        _token : __PHP().token()            //$PHP_TOKEN 
        data : {
            //Data
        }
    }
},

// Generation of a Valid Token
$PHP_TOKEN      //"4HEsdy.........."
__PHP().token() //"4HEsdy.........."
```