# PHP2JS (LARAVEL) 
> [![Raul Mauricio Uñate Castro](https://storage.googleapis.com/lola-web/storage_apls/RecursosCompartidos/LogoGithubLibrerias.png)](#)
## Lea las variables retornadas desde el controlador en archivos externos de JavaScript que use desde:
`<script src="{{ asset('..............js') }}"></script>`

Lea las variables de PHP LARAVEL en un archivo externo de JAVASCRIPT sin necesidad de hacer peticiones AJAX, FETCH o AXIOS, use las mismas variables del archivo retornado por el controlador.

- Leer todas las variables retornadas desde el controlados en archivos externos de JavaScript para mantener una estructura limpia de Codigo.
- Conozca la ruta donde se ejecuta el Script.
- Obtenga la URL completa o con parametros en uso sin necesidad de metodos de JavaScript.
- Obtenga el Dominio en uso.
- Obtenga un CSRF Tokken valido en cualquier lugar de su JavaScript
- Genere una etiqueta `<meta>` con el CSRF TOKEN.
- Genere una etiqueta `<inpuy type="hidden">` con el CSRF TOKEN.


# Instalación
## _Instalación a través de Composer_

```console
composer require rmunate/php2js v2.0.x-dev
```

## (OPCIONAL) Presentar el Proveedor en el archivo config\app.php. 

```php
'providers' => [
    //..
    Rmunate\Php2Js\PHP2JSServiceProvider::class,
],
```

## Uso
En la vista antes de llamar el(los) archivo(s) externo(s) de JavaScript, se debe poner la directiva `@__PHP()` esta debe estar una unica vez. Esto hará que todas las variables seteadas desde PHP se puedan leer en todos los archivos de JavaScript que se ingresen por src.


```php
@__PHP()
<script src="{{ asset('..............js') }}"></script>
```

## Metodos
Invoque el metodo que requiera.

| METODO | DESCRIPCIÓN |
| ------ | ------ |
| `__PHP().all()` | Retorna toda la información de las variables en uso dentro de un objeto. |
| `__PHP().vars()` | Retorna exclusivamente las variables seteadas en PHP en un objeto. |
| `__PHP().errors()` | Retorna los errores de captura de las variables de PHP. |
| `__PHP().path()` | Retorna el nombre del archivo desde el cual se está capturando las variables. |
| `__PHP().env()` | Retorna variables de entorno generadas en la acción de tomar las variables (No retorna los datos el ENV de laravel), comúnmente no se generan por lo cual retorna vacío. |
| `__PHP().app()` | Retorna variables guardadas en el objeto principal App. |
| `__PHP().route()` | Retorna el nombre de la ruta según el archivo de rutas de laravel. |
| `__PHP().fullUrl()` | Retorna la URL completa, en caso de envíos tipo GET, retorna la URL con los parámetros. |
| `__PHP().url()` | Retorna la URL completa, sin parámetros |
| `__PHP().root()` | Retorna el dominio en uso. |
| `__PHP().token()` | Retorna un CSRF TOKEN. |
| `__PHP().tokenMeta()` | Retorna una etiqueta meta con el CSRF TOKEN. |
| `__PHP().tokenInput()` | Retorna un input oculto con el CSRF TOKEN. |

```javascript

// Leer todas las variables de PHP desde JavaScript

__PHP().vars() //Esto retornara un objeto con las variables como atributos:

//Ejemplo si desde el controlador se retorno una variable $name, 
//desde JavaScript se seleccionará de la siguiente forma:
__PHP().vars().name

```
## Mantenedores
- Ingeniero, Raúl Mauricio Uñate Castro (raulmauriciounate@gmail.com)

[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)