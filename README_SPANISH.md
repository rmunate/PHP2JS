# PHP2JS  (LARAVEL PHP Framework) v3.x

![logo](https://user-images.githubusercontent.com/91748598/236917119-68ae265f-56b4-433e-a0f4-4379c2e93e99.png)

## Una nueva y segura forma de compartir variables entre las vistas Blade y Archivos de JavaScript.

Todas las importaciones que uses con la siguiente sintaxis `<script src="{{ asset('..............js') }}"></script>` ó los `<script> ... </script>` que crees directamente en la vista, luego de invocar algún método de esta librería tendrán acceso a las variables o bloques de datos que hayas definido desde el controlador o desde la directiva Blade, podrás separar la lógica de JavaScript de tus vistas Blade sin necesidad de hacer consultas o peticiones al servidor para obtener la información ya existente en el Front.

-	Definir desde el controlador si las variables retornadas serán compartidas a nivel de JavaScript.
-	Manejar una sintaxis similar a la que suministra el marco de trabajo para retornar vistas.
-	Definir si se agregarán bloques de datos útiles para manipulaciones y gestiones en el Front desde la programación con JavaScript.
-	Definir el Alias de entrada a los valores retornados por el controlador, evitando así usar un identificador genérico que pueda ser consultado por la consola o por medio de otros métodos **Recomendado**.
-	Mismas funcionalidades desde directivas Blade que desde retorno de vistas desde el controlador.
-	Obtener un conjunto de datos que facilitaran el trabajo en nuestras aplicaciones.
-	Identificar desde donde me conecto y manipular estos datos desde JS, definiendo el comportamiento de la Aplicación, saber si es móvil o si es desktop.
-	Conocer las versiones de los sistemas en uso.
-	Tener a la mano la BaseUrl para las peticiones al servidor.
-	Obtener los datos del usuario en sesión para mejorar la experiencia desde JS.
-	Conocer que navegador se usa, que versión, que plataforma.
-	Conocer la IP desde donde se consume la aplicación
-	Esto es una descripcion muy corta para las características que te brinda esta librería.


## _Instalacion_

```console
composer require rmunate/php2js
```

Asegúrate de que en el `composer.json` tengas la biblioteca en la última versión. `"rmunate/php2js": "^3.5"`

## Funcionalidades de la librería desde los controladores.
Tendrás la facilidad de retornar tus vistas definiendo si compartirás tus variables con JavaScript a través de diferentes metodos.

### Retornar una vista sin compartir datos con JavaScript
```php

//Importar Uso De Libreria
use Rmunate\Php2Js\Render;

// 1 - Usando solo el metodo "view" con "compact"
return Render::view('welcome', compact('variable',...))->compose();

// 2 - Usando solo el metodo "view" sin "compact"
return Render::view('welcome',['nombre' => $valor])->compose();

// 3 - Usando el metodo "view", el metodo "with" y "compact"
return Render::view('welcome')->with(compact('variable',...))->compose();

// 4 - Usando el metodo "view", el metodo "with" sin "compact"
return Render::view('welcome')->with(['nombre' => $valor])->compose();

```

### Retornar una vista compartiendo todas las variables retornadas por el controlador con JavaScript
La sintaxis será la misma vista anteriormente solo que se le agregará algunos nuevos métodos que te facilitaran compartir las variables con JavaScript.

```php

//Importar Uso De Libreria
use Rmunate\Php2Js\Render;

//El metodo "toJS()" compartira todas las variables retornadas a la vista con JavaScript, ahora tendras en JS disponible la constante "PHP2JS"
return Render::view('welcome')->with(['nombre' => $valor])->toJS()->compose();

//Si quieres usar un nombre de constante diferente RECOMENDADO, podras hacerlo como se muestra a continuación, donde pondremos de nombre "MiAlias"
return Render::view('welcome')->with(['nombre' => $valor])->toJS('MiAlias')->compose();

```

### Retornar una vista compartiendo solo las variables que se desee con JavaScript

```php

//Importar Uso De Libreria
use Rmunate\Php2Js\Render;

//El metodo "toStrictJS()" compartira solo las variables deseadas con JavaScript, ahora tendras en JS disponible la constante "PHP2JS" con estos valores.

$dato1 = 'Ejemplo De Variable 1';
$dato2 = 'Ejemplo De Variable 2';

//Usando Compact
return Render::view('pages.guest.index')->toStricJS(compact('dato1'))->compose();

//Sin Usar Compact
return Render::view('pages.guest.index')->toStricJS(['dato1' => $dato1])->compose();

//Retornar valores diferentes a la vista y a JavaScript
return Render::view('pages.guest.index')->with(['dato1' => $dato1])->toStricJS(['dato2' => $dato2])->compose();

//Usar un nombre personalizado de la constante de entrada a los valores en JavaScript
return Render::view('pages.guest.index')->toStricJS(['dato1' => $dato1],'MiAlias')->compose();

```

### Retornar una vista compartiendo variables y bloques de información util con JavaScript

```php

//Importar Uso De Libreria
use Rmunate\Php2Js\Render;

//El metodo "attach()" compartirá adicional a las variables, bloques de información que te servirán para el trabajo en tus archivos JavaScript.

//Al metodo "attach()" podras enviarle uno o varios identificadores de los bloques disponibles en la versión actual de la libreria.

return Render::view('pages.guest.index')->with(['dato1' => $dato1])->toJS()->attach('agent','url','csrf','framework','php','user')->compose();

return Render::view('pages.guest.index')->toStricJS(['dato1' => $dato1])->attach('agent','url','csrf','framework','php','user')->compose();

```

En los ejemplos anteriores si notas, es la misma sintaxis que siempre usas en el marco de trabajo actual, sin embargo, tendrás métodos nuevos. Estos métodos siempre deben estar previo al metodo final `->compose()`;
LOS BLOQUES DE INFORMACION ADICIONAL CONTIENEN:

| BLOQUE | DATOS |
| ------ | ------ |
| `agent` | agent : {identifier,remote_ip,remote_port,browser,isMobile,OS} Podrás conocer desde que dispositivo se ejecuta la conexión, el navegador en uso, si es una conexión desde un dispositivo móvil, la dirección ip de origen de la conexión, el puerto en uso. |
| `url` | url : {baseUrl,fullUrl,uri,scheme,parameters:{route,get,post}} Podrás conocer los datos de la URL en uso, los parámetros pasados, la URI, la base URL para peticiones al servidor, etc. |
| `csrf` | Retorna un token valido para peticiones desde JavaScript, así podrás hacer peticiones AJAX por ejemplo agregando el token dentro de la carga útil. |
| `framework` | framework:{version,environment:{name,debug}} Retorna información referente al framework en uso como la versión y los valores no sensibles del ENV. |
| `php` | php:{id,version,release} Retorna información referente a la versión del PHP en uso. |
| `user` | user:{...} Retorna la información del usuario en sesión, el ID se retorna encriptado evitando mostrar información sensible, de igual forma no retorna datos como contraseña ni marcas de tiempo. |

Por defecto en JavaScript para poder acceder a estos valores retornados, usaras la constante PHP2JS, si le asignaste un nombre especifico como se recomienda deberán ingresar a los valores a través de él.  .

```javascript
PHP2JS.vars.variables
//or
ALIAS.vars.variables;
```

## Directivas En Vistas Blade

```php
//-------------------
//Todas las Directivas permiten aplicarle un Alias a la constante de entrada en JS
//-------------------

//Compartir la informacion del Agente de conexion.
@PHP2JS_AGENT() // @PHP2JS_AGENT('MiAlias')

//Compartir la informacion de la URL en uso.
@PHP2JS_URL() // @PHP2JS_URL('MiAlias')

//Compartir un token valido para laravel.
@PHP2JS_CSRF() // @PHP2JS_CSRF('MiAlias')

//Compartir información no sencible de laravel.
@PHP2JS_FRAMEWORK() // @PHP2JS_FRAMEWORK('MiAlias')

//Compartir información no sencible de PHP.
@PHP2JS_PHP() // @PHP2JS_PHP('MiAlias')

//Compartir información no sencible del usuario en sesión.
@PHP2JS_USER() // @PHP2JS_USER('MiAlias')

//Compartir con JavaScript todas las variables definidas o retornadas por el controlador. Se se han definido mas variables desde la vista, estas seran comportidas con JavaScript
@PHP2JS_VARS() // @PHP2JS_VARS('MiAlias')

//Compartir solo las variables que se deseen con JavaScript, debe ir solo el nombre de la variable dentro de un arreglo como se muestra a continuación.
@PHP2JS_VARS_STRICT(['variable1','variable2']) // @PHP2JS_VARS_STRICT(['variable1','variable2'],'MiAlias')

```

> **¡Importante!** _Recuerda que la librería siempre retorna la misma variable así que debes evitar tener inconvenientes tratando de redefinir el mismo valor al instancias desde varios lugares las directivas.  ._


## Estructura Del Objeto Completo

```javascript

{ALIAS} = {
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
    token : //Token valido para laravel
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
