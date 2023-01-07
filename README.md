# PHP2JS()
Lea las variables de PHP LARAVEL en un archivo externo de JAVASCRIPT sin necesidad de hacer peticiones AJAX, FETCH o AXIOS, use las mismas variables del archivo retornado por el controlador.

[![N|Solid](https://i.ibb.co/ZLzQTpm/Firma-Git-Hub.png)](#)

## Instalación
# Instalar a traves de composer.
```sh
composer require rmunate/php2js
```

# (OPCIONAL) Presentar el Proveedor en el archivo config\app.php. 

```sh
'providers' => [
	//
	Rmunate\Php2Js\PHP2JSServiceProvider::class,
],
```

## Uso
En la vista antes de llamar el o los archivo externo de JavaScript, se debe poner la directiva `@__PHP()` esta debe estar una unica vez.
```sh
@__PHP()
<script src="{{ asset('..............js') }}"></script>
```

## Métodos (Doble Guión Al Piso (__))

| FUNCIÓN | DESCRIPCIÓN |
| ------ | ------ |
| __PHP().all() | Retorna toda la información de las variables en uso dentro de un objeto. |
| __PHP().vars() | Retorna exclusivamente las variables seteadas en PHP en un objeto. |
| __PHP().errors() | Retorna los errores de captura de las variables de PHP. |
| __PHP().path() | Retorna el nombre del archivo desde el cual se está capturando las variables. |
| __PHP().env() | Retorna variables de entorno generadas en la acción de tomar las variables (No retorna los datos el ENV de laravel), comúnmente no se generan por lo cual retorna vacío. |
| __PHP().app() | Retorna variables guardadas en el objeto principal App. |
| __PHP().route() | Retorna el nombre de la ruta según el archivo de rutas de laravel. |
| __PHP().fullUrl() | Retorna la URL completa, en caso de envíos tipo GET, retorna la URL con los parámetros. |
| __PHP().url() | Retorna la URL completa, sin parámetros |
| __PHP().root() | Retorna el dominio en uso. |
| __PHP().token() | Retorna un CSRF TOKEN. |
| __PHP().tokenMeta() | Retorna una etiqueta meta con el CSRF TOKEN. |
| __PHP().tokenInput() | Retorna un input oculto con el CSRF TOKEN. |

## Desarrollador

Ingeniero, Raúl Mauricio Uñate Castro
raulmauriciounate@gmail.com

## Licencia
MIT
