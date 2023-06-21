# PHP2JS  (LARAVEL PHP Framework) v3.0.0

![logo](https://user-images.githubusercontent.com/91748598/236917119-68ae265f-56b4-433e-a0f4-4379c2e93e99.png)

## Una nueva y segura forma de compartir variables entre las vistas Blade y Archivos de JavaScript.

Todas las importaciones que uses con la siguiente sintaxis `<script src="{{ asset('..............js') }}"></script>` ó los `<script> ... </script>` que crees directamente en la vista, luego de invocar algún método de esta librería tendrán acceso a las variables retornadas desde el controlador, podrás separar la lógica de JavaScript de tus vistas Blade sin necesidad de hacer consultas o peticiones al servidor para obtener la información ya existente en el Front.

-	Definir desde el controlador si las variables retornadas serán compartidas a nivel de JavaScript.
-	Manejar una sintaxis idéntica a la que suministra el marco de trabajo para retornar vistas.
-	Definir si se agregarán bloques de datos útiles para manipulaciones y gestiones en el Front desde la programación con JavaScript.
-	Generación de archivos con identidades únicas y no consecuentes para evitar cualquier tipo de inspección de código.
-	Definir el Alias de entrada a los valores retornados por el controlador, evitando así usar un identificador genérico que pueda ser consultado por la consola o por medio de otros métodos.
-	Mismas funcionalidades desde directivas Blade que desde retorno de vistas desde el controlador.
-	Obtener un conjunto de datos que facilitaran el trabajo en nuestras aplicaciones.
-	Identificar desde donde me conecto y manipular estos datos desde JS, definiendo el comportamiento de la Aplicación, saber si es móvil o si es desktop.
-	Conocer las versiones de los sistemas en uso.
-	Tener a la mano la BaseUrl para las peticiones al servidor.
-	Obtener los datos del usuario en sesión para mejorar la experiencia desde JS.
-	Conocer que navegador se usa, que versión, que plataforma.


## _Instalacion_

```console
composer require rmunate/php2js
```

Asegúrate de que en el `composer.json` tengas la biblioteca en la última versión. `"rmunate/php2js": "^3.0"`

## Funcionalidades de la librería desde los controladores.
Tendrás la facilidad de retornar tus vistas definiendo si compartirás tus variables con JavaScript a través de cuatro posibles metodos

```php

use Rmunate\Php2Js\Render;

/* Empleando Compact */
return Render::view('welcome', compact('variable1','variable2','variable3','...'))->toJS()->compose();

/* Empleando With */
return Render::view('welcome')->with(compact('variable1','variable2','variable3','...'))->toJS()->compose();

/* Mismo metodo pero con arreglo asociativo */
return Render::view('welcome')->with([
    'variable1' => $variable1,
    ...
])->toJS()->compose();

```
En los ejemplos anteriores si notas, es la misma sintaxis que siempre usas en el marco de trabajo actual, sin embargo, tendrás dos métodos nuevos. De estos dos métodos nuevos en la siguiente tabla se muestras los usos de lo referente a enviar las variables a JavaScript, por otro lado el método `->compose()` siempre debe ir al final, podrás si así lo deseas retornar la vista sin compartir datos solo anidando el método `Render::view(‘nombre_vista’)->compose()` ó `Render::view(‘nombre_vista’, compact('var...'))->compose()`;

| METHOD | DESCRIPTION | RETURN |
| ------ | ------ | ------ |
| `->toJS(string $Obj='PHP')` | Este método es el recomendado por los creadores de esta funcionalidad, permite que desde JavaScript se tenga acceso a todas las variables retornadas desde el controlador, así como a los datos de la URL en uso y al uso de un token valido para Laravel. | { vars : {…}, url : {…}, csrf : {…}} |
| `->toAllJS(string $Obj='PHP')` | Este método retorna toda la data que se ha determinado como útil para el trabajo desde JavaScript con los datos retornados desde el controlador. Otorgan una gran cantidad de datos que se podrán emplear para mejorar el rendimiento y la personalización de nuestra aplicación según sea el caso. | { vars : {…} , url : {…}, csrf : {…}, php : {…}, laravel : {…}, user : {…}, agent : {…}} |
| `->toStrictJS(string $Obj='PHP')` | Este método retorna exclusivamente la información de las variables devueltas por el controlador, no retorna ningún valor adicional. | { vars : {…}} |
| `->toJSWith(array $grp = [], string $Obj='PHP')` | Si quieres definir qué información compartir con JavaScript adicional a las variables retornadas por el controlador, este método recibirá en primera posición un arreglo donde podrás ingresar cualquiera de las siguientes opciones `[url,csrf,php,laravel,user,agent]` de los valores preparados para uso, los cuales serán compartidos con JavaScript.. | { vars : {…}, [...]} |

Por defecto en JavaScript para poder acceder a estos valores retornados, usaras la constante PHP.

```javascript
PHP.vars.mivariable
```

Sin embargo desde el controlador puedes asignar un nombre diferente a esta constante, lo cual se recomienda.
Lo haremos de esta manera en el controlador.
```php
use Rmunate\Php2Js\Render;

return Render::view('welcome', compact('mivariable'))->toJS('_PHP2JS')->compose();
```
Lo leemos de esta manera en JS.
```javascript
_PHP2JS.vars.mivariable
```

Ahora para continuar con el estándar de las anteriores versiones de la Liberia, también podrás crear un puente entre PHP Laravel y JavaScript desde las vistas con directivas Blade. En estos casos no será necesario que en el controlador emplees la sintaxis de esta librería, (aunque si deseas puedes hacerlo ya que es la misma funcionalidad original del marco), tendrás las siguientes directivas disponibles al momento.

| DIRECTIVE | DESCRIPTION | RETURN |
| ------ | ------ | ------ |
| `@toJS(string $Obj='PHP2JS')` | Esta directiva es el recomendado por los creadores de esta funcionalidad, permite que desde JavaScript se tenga acceso a todas las variables retornadas desde el controlador y a las creadas previo a instanciar la directiva, así como a los datos de la URL en uso y al uso de un token valido para Laravel. | { vars : {…}, url : {…}, csrf : {…}} |
| `@toAllJS(string $Obj='PHP2JS')` | Esta directiva retorna toda la data que se ha determinado como útil para el trabajo desde JavaScript con los datos retornados desde el controlador. Otorgan una gran cantidad de datos que se podrán emplear para mejorar el rendimiento y la personalización de nuestra aplicación según sea el caso. | { vars : {…} , url : {…}, csrf : {…}, php : {…}, laravel : {…}, user : {…}, agent : {…}} |
| `@toStrictJS(string $Obj='PHP2JS')` | Esta directiva retorna exclusivamente la información de las variables devueltas por el controlador, no retorna ningún valor adicional. | { vars : {…}} |

Recuerda que puedes pasarle como argumento el alias que quieras usar para su llamado desde JavaScript.

**Los valores que se retornan en general son los siguientes.**

```javascript
//ALIAS = Por defecto PHP desde controladores ó PHP2JS desde directivas Blade

ALIAS = {
    vars : //Variables leidas desde el Server,
    url : {
        baseUrl : //Base para peticiones al servidor.,
        fullUrl : //Url completa en uso.,
        uri : //Uri actual de acuerdo a las rutas de laravel.,
        parameters : {
            route : //Parametos enviados por ruta,
            get : //Parametos enviados como query get por URL,
            post : //Parametos enviados con el metodo POST,
        },
        scheme : //HTTPx.,
    },
    csrf : {
        token : //Token valido para laravel
    },
    php : {
        id: //Id Release,
        version : //Version PHP en uso,
        release : //Release En Uso
    },
    laravel : {
        version : //Version de Laravel en uso,
        environment : {
            name: //Nombre de la aplicación en el env,
            debug: //True - False según la configuración del env,
        }
    },
    user : {
        // Datos no sencibles del usuario en sesión
    },
    agent : {
        identifier : //Valor completo del agente., 
        remote_ip : //Ip desde donde consumen la aplicación., 
        remote_port : //Puerto de la Ip Remota desde donde consumen la aplicación., 
        browser : {
            //Valores del Navegador
        }, 
        isMobile: //Seber si es una conexion desde equipos moviles
        OS : //Sistema operativo de quien se conecta
    }
}
```

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
