# PHP2JS()
Lea las variables de PHP LARAVEL en un archivo externo de JAVASCRIPT

[![N|Solid](https://i.ibb.co/ZLzQTpm/Firma-Git-Hub.png)](#)

## Instalación
1.	Copiar el Archivo AltumServiceProvider.php en la ruta app\Providers.
2.	Presentar el Proveedor en el archivo config\app.php.

```sh
'providers' => [
	//
	App\Providers\AltumServiceProvider::class,
],
```

## Uso
En la vista antes de llamar el archivo externo de JavaScript, se debe poner la directiva 
```sh
@PHP2JS()
<script src="{{ asset('..............js') }}"></script>
```

## Métodos

| FUNCIÓN | DESCRIPCIÓN |
| ------ | ------ |
| __php().all() | Retorna toda la información de las variables en uso dentro de un objeto. |
| __php().vars() | Retorna exclusivamente las variables seteadas en PHP en un objeto. |
| __php().errors() | Retorna los errores de captura de las variables de PHP. |
| __php().path() | Retorna el nombre del archivo desde el cual se está capturando las variables. |
| __php().env() | Retorna variables de entorno generadas en la acción de tomar las variables (No retorna los datos el ENV de laravel), comúnmente no se generan por lo cual retorna vacío. |
| __php().app() | Retorna variables guardadas en el objeto principal App. |
| __php().route() | Retorna el nombre de la ruta según el archivo de rutas de laravel. |
| __php().fullUrl() | Retorna la URL completa, en caso de envíos tipo GET, retorna la URL con los parámetros. |
| __php().url() | Retorna la URL completa, sin parámetros |
| __php().root() | Retorna el dominio en uso. |
| __php().token() | Retorna un CSRF TOKEN. |
| __php().tokenMeta() | Retorna una etiqueta meta con el CSRF TOKEN. |
| __php().tokenInput() | Retorna un input oculto con el CSRF TOKEN. |

## Desarrollador

Ingeniero, Raúl Mauricio Uñate Castro
raulmauriciounate@gmail.com

## Licencia
MIT
