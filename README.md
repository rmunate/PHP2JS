# PHP2JS (LARAVEL) 

![logo](https://user-images.githubusercontent.com/91748598/236917119-68ae265f-56b4-433e-a0f4-4379c2e93e99.png)

## Lea las variables retornadas desde el controlador y definidas en la vista Blade en archivos externos de JavaScript, perfecta libreria para monolitos con Blade.
Todas las importaciones que emplee de la siguiente forma, despues de invocar esta libreria tendran acceso a las variables de PHP, facil y muy util.
`<script src="{{ asset('..............js') }}"></script>`

Lea las variables de PHP en archivos externos de JavaScript sin necesidad de hacer peticiones AJAX, FETCH o AXIOS innecesarias, use las mismas variables retornadas por el controlador o creadas en la vista antes de invocar la libreria, al igual que unos valores adicionales que simplificarán tu trabajo enormemente.

- Leer todas las variables retornadas desde el controlador en archivos externos de JavaScript para mantener una estructura limpia de Codigo.
- Leer todas las variables declaradas en la vista Blade, desde archivos externos de JavaScript.
- Obtenga la informacion de la URL en uso, el protocolo, la URI, los parametros, etc.
- Obtenga la información de la version de PHP en USO. Version, Id, etc.
- Obtenga el los datos del AGENT, ip remota desde donde se ingresa al sistema, puerto en uso, etc.
- Obtenga un CSRF Tokken valido en cualquier lugar de su JavaScript
- Obtenga los datos relevantes del Usuario en sesión, protegiendo el ID con el Helper de Laravel Crypt::encrypt($id), aplique la inversa si lo necesita.
- Nunca habia sido tan facil integrar las dos capas de Desarrollo.

# Instalación
## _Instalación a través de Composer_

```console
composer require rmunate/php2js
```

## Presentar el Proveedor en el archivo config\app.php. (Laravel 8 o Inferiores)

```php
'providers' => [
    //..
    Rmunate\Php2Js\PHP2JSServiceProvider::class,
],
```

## Uso
En la vista antes de llamar el(los) archivo(s) externo(s) de JavaScript, se debe poner la directiva `@__PHP()` esta debe estar una unica vez. 
Esto hará que todas las variables devueltas desde el servidor se puedan leer en todos los archivos de JavaScript que se ingresen en las siguientes lineas del código.


```php
@__PHP()
<script src="{{ asset('js/myscript.js') }}"></script>
```

## Metodos
Invoque el metodo que requiera o llame la constante en cualquier lugar de su codigo JavaScript.

| METODO | CONSTANTE | DESCRIPCIÓN |
| ------ | ------ | ------ |
| `__PHP().all()` | `$PHP` | Retorna un objeto con toda la información disponible retornada por el servidor a un solo nivel. |
| `__PHP().groups()` | `$PHP_GROUPS` | Retorna un objeto en grupos de la información disponible retornada por el servidor (Recomendado). |
| `__PHP().vars()` | `$PHP_VARS` | Retorna exclusivamente las variables devueltas desde el controlador en un objeto. |
| `__PHP().baseUrl()` | `$PHP_BASE_URL` | Retorna la URL base del Sistema para peticiones Ajax, Axios, Fetch o similares. |
| `__PHP().fullUrl()` | `$PHP_FULL_URL` | Retorna la URL completa con sus parámetros. |
| `__PHP().parameters()` | `$PHP_PARAMETERS` | Retorna los parametros de la URL. |
| `__PHP().uri()` | `$PHP_URI` | Retorna la URI de acuerdo a las Rutas de Laravel |
| `__PHP().scheme()` | `$PHP_SCHEME` | Retorna el esquema en uso HTTP ó HTTPS |
| `__PHP().token()` | `$PHP_TOKEN` | Retorna un CSRF TOKEN. |
| `__PHP().tokenMeta()` | `$PHP_TOKEN_META` | Retorna una etiqueta meta con el CSRF TOKEN. |
| `__PHP().tokenInput()` | `$PHP_TOKEN_INPUT` | Retorna un input oculto con el CSRF TOKEN. |
| `__PHP().php_version()` | `$PHP_VERSION` | Retorna la versión en uso de PHP. |
| `__PHP().php_id()` | `$PHP_ID` | Retorna el ID de la versión en uso de PHP. |
| `__PHP().php_release()` | `$PHP_RELEASE` | Retorna el Release de la versión en uso de PHP. |
| `__PHP().agent()` | `$PHP_AGENT` | Retorna el valor del Agente en conexión. (Navegador, dispositivo, etc). |
| `__PHP().remote_ip()` | `$PHP_AGENT_REMOTE_IP` | Retorna la dirección IP desde donde se esta consumiendo el sistema. |
| `__PHP().remote_port()` | `$PHP_AGENT_REMOTE_PORT` | Retorna el puerto en uso desde donde se esta consumiendo el sistema. |
| `__PHP().browser()` | `$PHP_AGENT_BROWSER` | Retorna los detalles del navegador en uso. |
| `__PHP().is_mobile()` | `$PHP_AGENT_IS_MOBILE` | Retorna TRUE si se esta conectado al sistema desde un dispositivo movil. |
| `__PHP().mobile_os_android()` | `$PHP_AGENT_MOBILE_OS_ANDROID` | Retorna TRUE si se esta conectado al sistema desde un Android. |
| `__PHP().mobile_os_iphone()` | `$PHP_AGENT_MOBILE_OS_IPHONE` | Retorna TRUE si se esta conectado al sistema desde un IPHONE. |
| `__PHP().os_linux()` | `$PHP_AGENT_OS_LINUX` | Retorna TRUE si se esta conectado al sistema desde un OS LINUX. |
| `__PHP().os_ios()` | `$PHP_AGENT_OS_IOS` | Retorna TRUE si se esta conectado al sistema desde un OS IOS MAC. |
| `__PHP().os_windows()` | `$PHP_AGENT_OS_WINDOWS` | Retorna TRUE si se esta conectado al sistema desde un Windows. |
| `__PHP().user()` | `$PHP_USER` | Retorna la informacion del usuario en sesíon con el ID encriptado. |
| `__PHP().debug()` | `$PHP_DEBUG` | Retorna el estado de la variable APP_DEBUG del ENV de Laravel. |

```javascript

/* Esto retornara un objeto con todos los valores disponibles del servidor. */
__PHP().all()
// {
//     "vars": {
//         //..Variables Retornadas por el backend
//     },
//     "baseUrl": "http://127.0.0.1:8000",
//     "fullUrl": "http://127.0.0.1:8000/branches/branch404",
//     "parameters": {
//         "id": "branch404"
//     },
//     "uri": "branches/{id}",
//     "token": "4HEsdymdvgs1aVnXdFz9EhroNlJtS6uVrSznCyOL",
//     "tokenMeta": "<meta name=\" csrf-token\" content=\"4HEsdymdvgs1aVnXdFz9EhroNlJtS6uVrSznCyOL\">",
//     "tokenInput": "<input type\"hidden\" name=\"_token\" value=\"4HEsdymdvgs1aVnXdFz9EhroNlJtS6uVrSznCyOL\"/>",
//     "user": {
//         "id": yDHEsdymdvgs1aVnXdFz9EhroNlJtS6uVrSznCyOL...,
//         "name": "Nombre Usuario",
//         "username": "name_user",
//         "email": "admin@system.co"
//     }
//     // ...
// }

/* Leer todas las variables de PHP desde JavaScript con este metodo. */
__PHP().groups() //Acceso por metodo
$PHP_GROUPS      //Acceso por constante

/* Ingresar directamente a una variable retornada por el controlador */
__PHP().vars().ejemplo //Equivale a la variable $ejemplo.
$PHP_VARS.ejemplo      //Equivale a la variable $ejemplo.

/* Llamado a las base url para peticiones al servidor */
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

/* Generacion de un Token Valido */
__PHP().token() //"4HEsdymdvgs1aVnXdFz9EhroNlJtS6uVrSznCyOL"
$PHP_TOKEN      //"4HEsdymdvgs1aVnXdFz9EhroNlJtS6uVrSznCyOL"
```
## Mantenedores
- 🇨🇴 Raúl Mauricio Uñate Castro. (raulmauriciounate@gmail.com)

## Desarrolladores Aportantes
- 🇨🇴 Wirmer A. Sanchez Saez
- 🇨🇴 Jorge Hernan Castañeda (ds.jorgecastaneda@gmail.com)
- 🇲🇽 Julio C. Borges (julio-borgeslopez@outlook.com)


[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)
