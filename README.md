# PHP2JS (LARAVEL) 

![logo](https://user-images.githubusercontent.com/91748598/236917119-68ae265f-56b4-433e-a0f4-4379c2e93e99.png)

## Lea las variables retornadas desde el controlador en archivos externos de JavaScript, perfecta libreria para monolitos con Blade.
Todas las importaciones que emplee de esta forma, despues de invocar esta libreria tendran acceso a las variables de PHP Laravel, facil y muy util.
`<script src="{{ asset('..............js') }}"></script>`

Lea las variables de PHP LARAVEL en un archivo externo de JAVASCRIPT sin necesidad de hacer peticiones AJAX, FETCH o AXIOS, use las mismas variables del archivo retornado por el controlador, al igual que unos valores adicionales que simplificarán tu trabajo.

- Leer todas las variables retornadas desde el controlador en archivos externos de JavaScript para mantener una estructura limpia de Codigo.
- Consulte y use información relevante de la URL o ruta en uso.
- Obtenga la URL completa con parametros, sin necesidad de metodos de JavaScript.
- Obtenga el Dominio en uso y la base URL para peticiones al servidor.
- Obtenga un CSRF Tokken valido en cualquier lugar de su JavaScript
- Genere una etiqueta `<meta>` con el CSRF TOKEN.
- Genere una etiqueta `<inpuy type="hidden">` con el CSRF TOKEN.


# Instalación
## _Instalación a través de Composer_

```console
composer require rmunate/php2js
```

## Presentar el Proveedor en el archivo config\app.php. (Opcional)

```php
'providers' => [
    //..
    Rmunate\Php2Js\PHP2JSServiceProvider::class,
],
```

## Uso
En la vista antes de llamar el(los) archivo(s) externo(s) de JavaScript, se debe poner la directiva `@__PHP()` esta debe estar una unica vez. Esto hará que todas las variables devueltas desde el servidor se puedan leer en todos los archivos de JavaScript que se ingresen en las siguientes lineas del código.


```php
@__PHP()
<script src="{{ asset('js/miarchivo.js') }}"></script>
```

## Metodos
Invoque el metodo que requiera o llame la constante en cualquier lugar de su codigo JavaScript.

| METODO | CONSTANTE | DESCRIPCIÓN |
| ------ | ------ |
| `__PHP().all()` |  | Retorna un objeto con toda la información disponible retornada por el servidor. |
| `__PHP().vars()` | `$PHP_BASE_URL` | Retorna exclusivamente las variables devueltas desde el controlador en un objeto. |
| `__PHP().baseUrl()` | `$PHP_BASE_URL` | Retorna la URL base del Sistema para peticiones Ajax, Axios, Fetch o similares. |
| `__PHP().fullUrl()` | `$PHP_FULL_URL` | Retorna la URL completa con sus parámetros. |
| `__PHP().parameters()` | `$PHP_PARAMETERS` | Retorna los parametros de la URL. |
| `__PHP().uri()` | `$PHP_URI` | Retorna la URI de acuerdo a las Rutas de Laravel |
| `__PHP().token()` | `$PHP_TOKEN` | Retorna un CSRF TOKEN. |
| `__PHP().tokenMeta()` | `$PHP_TOKEN_META` | Retorna una etiqueta meta con el CSRF TOKEN. |
| `__PHP().tokenInput()` | `$PHP_TOKEN_INPUT` | Retorna un input oculto con el CSRF TOKEN. |
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
// }

/* Leer todas las variables de PHP desde JavaScript con este metodo. */
__PHP().vars() //Acceso por metodo
$PHP_VARS      //Acceso por constante

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
