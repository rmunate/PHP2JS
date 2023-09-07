# PHP2JS (La Bibloteca que volvio simple el manejo de Monolitos En Laravel) (LARAVEL PHP Framework) v3.x
⚙️ Esta librería es compatible con versiones de Laravel 9.0 y superiores ⚙️

[![Laravel 9.0+](https://img.shields.io/badge/Laravel-9.0%2B-orange.svg)](https://laravel.com)
[![Laravel 10.0+](https://img.shields.io/badge/Laravel-10.0%2B-orange.svg)](https://laravel.com)

![logo-php2js](https://github.com/alejandrodiazpinilla/PHP2JS/assets/51100789/f3c09be3-8013-44de-87fe-946b55f14514)

📖 [**DOCUMENTACIÓN EN INGLÉS**](README.md) 📖

# Tabla de Contenido
1. [Introducción](#introducción)
2. [Instalación](#instalación)
3. [Uso](#uso)
   1. [Controladores Laravel](#controladores-laravel)
      1. [Retornar Vista Convencional](#retornar-vista-convencional)
      2. [Retornar Vista Compartiendo Variables Con JavaScript](#retornar-vista-compartiendo-variables-con-javascript)
      3. [Retornar Vista Compartiendo Solo Ciertas Variables Con JavaScript](#retornar-vista-compartiendo-solo-ciertas-variables-con-javascript)
      4. [Retornar Vista Compartiendo Bloques Preconstruidos Con JavaScript](#retornar-vista-compartiendo-bloques-preconstruidos-con-javascript)
   2. [Directivas Blade](#directivas-blade)
      1. [Compartir Los Datos Del Agente De Conexión](#compartir-los-datos-del-agente-de-conexión)
      2. [Compartir Los Datos De La URL](#compartir-los-datos-de-la-url)
      3. [Compartir Token Valido](#compartir-token-valido)
      4. [Compartir Información Del Framework](#compartir-información-del-framework)
      5. [Compartir Información De PHP](#compartir-información-de-php)
      6. [Compartir Información Del Usuario En Sesión](#compartir-información-del-usuario-en-sesión)
      7. [Compartir Variables Existentes en PHP con JavaScript](#compartir-variables-existentes-en-php-con-javascript)
      8. [Compartir Solo Algunas Variables Existentes en PHP con JavaScript](#compartir-solo-algunas-variables-existentes-en-php-con-javascript)
   3. [Métodos en JavaScript](#métodos-en-javascript)
      1. [Limpiar (Clear)](#limpiar-clear)
      2. [Limpiar Sin Funciones (clearWithoutFunctions)](#limpiar-sin-funciones-clearwithoutfunctions)
      3. [Asignar (assign)](#asignar-assign)
      4. [Asignar Y Limpiar (assignAndClear)](#asignar-y-limpiar-assignandclear)
      5. [Asignar Y Limpiar Sin Funciones (assignAndClearWithoutFunctions)](#asignar-y-limpiar-sin-funciones-assignandclearwithoutfunctions)
      6. [Solo (only)](#solo-only)
      7. [Solo Funciones (onlyFunctions)](#solo-funciones-onlyfunctions)
      8. [Excepto (except)](#excepto-except)
      9. [Excepto Funciones (exceptFunctions)](#excepto-funciones-exceptfunctions)
      10. [Validar Si Existe Propiedad (hasProperty)](#validar-si-existe-propiedad-hasproperty)
      11. [Obtener Todas Las Propiedades (getAllProperties)](#obtener-todas-las-propiedades-getallproperties)
      12. [Asignar (set)](#asignar-set)
      13. [Obtener (get)](#obtener-get)
4. [Creador](#creador)
5. [Desarrolladores](#desarrolladores)
6. [Licencia](#licencia)


## Introducción.

La biblioteca PHP2JS proporciona diversas características valiosas para trabajar con JavaScript y Laravel:

1. **Acceso a Datos Compartidos**: Las variables o bloques de datos definidos desde el controlador o las directivas Blade están disponibles en las importaciones de JavaScript, lo que permite separar la lógica de JavaScript de las vistas Blade sin hacer consultas adicionales al servidor.
2. **Definición de Variables Compartidas**: El desarrollador puede elegir si las variables retornadas se compartirán a nivel de JavaScript, lo que proporciona flexibilidad en el manejo de datos entre el backend y el frontend.
3. **Sintaxis Similar a Laravel**: La biblioteca utiliza una sintaxis similar a la que proporciona Laravel para retornar vistas, lo que facilita su uso y reduce la curva de aprendizaje para los desarrolladores familiarizados con Laravel.
4. **Bloques de Datos Útiles**: Los bloques de datos útiles para manipulaciones y gestiones en el frontend permiten acceder a un conjunto de datos que facilitan el trabajo en las aplicaciones.
5. **Alias Personalizado**: El desarrollador puede definir un alias de entrada a los valores retornados por el controlador, lo que mejora la seguridad y evita el uso de identificadores genéricos que puedan ser accesibles desde la consola o por otros métodos.
6. **Funcionalidades Desde Blade y Controlador**: Las mismas funcionalidades están disponibles tanto desde las directivas Blade como desde el retorno de vistas desde el controlador, lo que brinda una experiencia coherente para los desarrolladores.
7. **Información del Usuario**: La biblioteca proporciona información útil sobre el usuario, como el tipo de dispositivo, la versión del sistema, el navegador y la IP, lo que permite personalizar la experiencia del usuario desde JavaScript.
8. **Múltiples Métodos Útiles**: Los múltiples métodos útiles en JavaScript facilitan el tratamiento de la información entregada por PHP Laravel, mejorando la eficiencia y la productividad del desarrollo.

En resumen, la biblioteca PHP2JS ofrece una serie de características poderosas que simplifican la comunicación entre el backend de Laravel y el frontend de JavaScript, lo que facilita la creación de aplicaciones web eficientes y personalizadas.

## Instalación
Para instalar la dependencia a través de Composer, ejecuta el siguiente comando:

```console
composer require rmunate/php2js
```

Asegúrate de que en el `composer.json` tengas la biblioteca en la última versión. `"rmunate/php2js": "^3.8"`
Siempre luego de instalar o actualizar ejecuta el comando.
```console
php artisan php2js:clear
```

## Uso
La Biblioteca ofrece diversas maneras de uso, desde los controladores de Laravel, así como desde las vistas a través de directivas simples de Blade. 
Tratamos de hacerlo lo más simple posible para que puedas familiarizarte fácilmente con el uso.

## Controladores Laravel
A continuación, se muestra el uso desde los controladores de Laravel.

### Retornar Vista Convencional
El siguiente código muestra cómo retornar una vista de forma convencional, sin compartir datos con JS, pero dejando una instancia de la biblioteca lista por si en futuras ocasiones se requiere compartir datos con JavaScript.

```php
// Importar Uso De Libreria
use Rmunate\Php2Js\Render;

// 1 - Usando solo el método "view" con "compact"
return Render::view('welcome', compact('variable', ...))->compose();

// 2 - Usando solo el método "view" sin "compact"
return Render::view('welcome', ['nombre' => $valor])->compose();

// 3 - Usando el método "view", el método "with" y "compact"
return Render::view('welcome')->with(compact('variable', ...))->compose();

// 4 - Usando el método "view", el método "with" sin "compact"
return Render::view('welcome')->with(['nombre' => $valor])->compose();
```

### Retornar Vista Compartiendo Variables Con JavaScript.
La sintaxis será la misma expuesta anteriormente, solo que se le agregarán algunos nuevos métodos que te facilitarán compartir las variables con JavaScript. En este escenario, usaremos el método `->toJS()`, este método comparte el 100% de las variables retornadas con JavaScript. Siempre será recomendable asignar un alias personalizado para entregar los valores a JavaScript.

```php
// Importar Uso De Libreria
use Rmunate\Php2Js\Render;

// El método "toJS()" compartirá todas las variables retornadas a la vista con JavaScript, ahora tendrás en JS disponible la constante "PHP2JS"
return Render::view('welcome')->with(['nombre' => $valor])->toJS()->compose();

// Si quieres usar un nombre de constante diferente **RECOMENDADO**, podrás hacerlo como se muestra a continuación, donde pondremos de nombre "MiAlias"
return Render::view('welcome')->with(['nombre' => $valor])->toJS('MiAlias')->compose();
```

### Retornar Vista Compartiendo Solo Ciertas Variables Con JavaScript.
Si tienes casos donde solo deseas compartir algunas variables con JavaScript, podrás hacerlo con total libertad, es más, si deseas puedes compartir valores diferentes entre la Vista Blade y JavaScript también podrás hacerlo. El método `->toStrictJS()` nos presta esta funcionalidad. Siempre será recomendable asignar un alias personalizado para entregar los valores a JavaScript.

```php
// Importar Uso De Libreria
use Rmunate\Php2Js\Render;

// El método "toStrictJS()" compartirá solo las variables deseadas con JavaScript, ahora tendrás en JS disponible la constante "PHP2JS" con estos valores.

$dato1 = 'Ejemplo De Variable 1';
$dato2 = 'Ejemplo De Variable 2';

// Usando Compact
return Render::view('pages.guest.index')->toStrictJS(compact('dato1'))->compose();

// Sin Usar Compact
return Render::view('pages.guest.index')->toStrictJS(['dato1' => $dato1])->compose();

// Retornar valores diferentes a la vista y a JavaScript
return Render::view('pages.guest.index')->with(['dato1' => $dato1])->toStrictJS(['dato2' => $dato2])->compose();

// Usar un nombre personalizado de la constante de entrada a los valores en JavaScript **RECOMENDADO**
return Render::view('pages.guest.index')->toStrictJS(['dato1' => $dato1], 'MiAlias')->compose();
```

### Retornar Vista Compartiendo Bloques Preconstruidos Con JavaScript.
PHP2JS trae de manera preconstruida algunos bloques de datos que consideramos podrán darte un valor agregado en ciertos tipos de desarrollo. Hemos dispuesto ciertos bloques que te mostraremos en este apartado, los cuales podrás atar al retorno de la vista para compartirlos con JavaScript. El método `->attach()` nos presta la funcionalidad de agregar estos datos al retorno de la Vista. Este método lo podrás usar después de los métodos `->toJS()` ó `->toStrictJS()`, como se muestra en el ejemplo. Siempre será recomendable asignar un alias personalizado para entregar los valores a JavaScript.

```php
// Importar Uso De Libreria
use Rmunate\Php2Js\Render;

// El método "attach()" compartirá adicional a las variables, bloques de información que te servirán para el trabajo en tus archivos JavaScript.
// Al método "attach()" podrás enviarle uno o varios identificadores de los bloques disponibles en la versión actual de la librería.

// Usando el método toJS
return Render::view('pages.guest.index')->with(['dato1' => $dato1])->toJS('MiAlias')->attach('agent', 'url', 'csrf', 'framework', 'php', 'user')->compose();

// Usando el método toStrictJS
return Render::view('pages.guest.index')->toStrictJS(['dato1' => $dato1], 'MiAlias')->attach('agent', 'url', 'csrf', 'framework', 'php', 'user')->compose();
```

### Contenido De Los Bloques Preconstruidos.

| BLOQUE | DATOS |
| ------ | ----- |
| `agent` | `agent: {identifier, remote_ip, remote_port, browser, isMobile, OS}`<br>Podrás conocer desde qué dispositivo se ejecuta la conexión, el navegador en uso, si es una conexión desde un dispositivo móvil, la dirección IP de origen de la conexión y el puerto. |
| `url` | `url: {baseUrl, fullUrl, uri, scheme, parameters: {route, get, post}}`<br>Podrás conocer los datos de la URL en uso, los parámetros pasados, la URI, la base URL para peticiones al servidor, etc. |
| `csrf` | `csrf: {token, tokenCookie}`<br>Retorna un token válido para peticiones desde JavaScript, lo que permite hacer peticiones AJAX, agregando el token dentro de la carga útil. |
| `framework` | `framework: {version, environment: {name, debug, context, url}}`<br>Retorna información referente al framework en uso, como la versión y los valores no sensibles del ENV. |
| `php` | `php: {id, version, release, serverSoftware, serverOperatingSystem, extensions, clientLanguage}`<br>Retorna información referente a la versión de PHP en uso y detalles del servidor. |
| `user` | `user: {...}`<br>Retorna la información del usuario en sesión. El ID se retorna encriptado para evitar mostrar información sensible, y no se incluyen datos como contraseña ni

 marcas de tiempo. |

### ¿Cómo Acceder Desde JavaScript?
Ahora que ya conoces cómo retornar los valores desde los controladores compartiendo los valores con JavaScript, te mostramos la manera cómo podrás acceder a ellos. Recuerda que si usaste un Alias personalizado como lo sugerimos, este alias se convertirá en una Constante dentro del entorno de JavaScript. Si no usaste un Alias, la constante por defecto que se crea es `PHP2JS`, sin embargo, siempre será recomendable crear un alias propio en cada caso.

```javascript
// En cualquier lugar del JavaScript podrás usar esta sintaxis para acceder.

// Sin Alias Propio 
PHP2JS.vars.variables;

// Con Alias Propio **RECOMENDADO**
ALIAS.vars.variables;
```

## Directivas Blade
Si en lugar de usar el controlador para compartir datos con JavaScript, prefieres hacerlo desde Blade, en ese caso podrás emplear la biblioteca de acuerdo a este apartado. Solo recuerda que siempre será conveniente usar un alias propio para cada caso. Además, si empleas más de una directiva, será obligatorio usar alias diferentes, puesto que en el contexto de JS no se pueden reescribir constantes ni declarar constantes con el mismo nombre.

### Compartir Los Datos Del Agente De Conexión.
Esta directiva te permite pasar un objeto con los datos del agente de conexión capturados por el servidor a JavaScript. No se emplea ningún método de captura con JS, todos los datos son leídos y pasados por el servidor a JavaScript.

```php
// Sin Alias
@PHP2JS_AGENT() 

// Con Alias **RECOMENDADO**
@PHP2JS_AGENT('MiAlias')
```

Esto le compartirá a JavaScript los siguientes datos:
```javascript
PHP2JS = {
    agent: {
        identifier:   // Agente De Conexión Registrado Desde El Servidor (No Se Registra Por Front),
        remote_ip:    // IP Remota de conexión del usuario capturada por el servidor,
        remote_port:  // Puerto Remoto de conexión del usuario capturada por el servidor,
        browser:      // Datos del Navegador en uso (Nombre, Versión y Plataforma),
        isMobile:     // Verdadero o Falso dependiendo si la conexión es desde un dispositivo móvil.
        OS:           // Sistema operativo empleado para conectarse a la aplicación.
    }
}
```

### Compartir Los Datos De La URL.
Esta directiva te permite pasar un objeto con los datos de la URL en uso a JavaScript. El objeto te permitirá acceder a los valores similar a cuando envías una petición al servidor.

```php
// Sin Alias
@PHP2JS_URL() 

// Con Alias **RECOMENDADO**
@PHP2JS_URL('MiAlias')
```

Esto le compartirá a JavaScript los siguientes datos:
```javascript
PHP2JS = {
    url: {
        baseUrl:      // Base URL que se empleará para peticiones AJAX, Axios, Fetch, etc.,
        fullUrl:      // URL Completa a la cual se está accediendo, sin borrar querys que pueda tener por URL,
        uri:          // URI, valor que está después del nombre del Dominio,
        parameters: {
            route:    // Parámetros pasados por la ruta de Laravel (GET),
            get:      // Parámetros enviados por URL (Query) (GET),
            post:     // Parámetros enviados por (POST),
        },
        scheme:       // Esquema HTTP en uso.,
        currentName:  // Nombre de la Ruta Asignado Desde Las Rutas De Laravel,
        isSecure:     // Define si cuenta con SSL,
    }
}
```

### Compartir Token Valido.
Esta directiva es de las más usadas, permite contar con un token de Laravel válido desde el tiempo de ejecución de JavaScript. El objeto contendrá un token válido al igual que el token entregado por galleta desde el Servidor.

```php
// Sin Alias
@PHP2JS_CSRF() 

// Con Alias **RECOMENDADO**
@PHP2JS_CSRF('MiAlias')
```

Esto le compartirá a JavaScript los siguientes datos:
```javascript
PHP2JS = {
    token:          // Token válido para peticiones al servidor por Request de Laravel,
    tokenCookie:    // Token entregado por Cookie desde el servidor,
}
```

### Compartir Información Del Framework.
Esta directiva permite conocer algunos datos inherentes al Framework. Permite definir en muchos casos, según se ha medido su uso, para poder determinar si el debugger de la aplicación está activa para ejecutar algunas acciones desde JS. Puede que encuentres más utilidades.

```php
// Sin Alias
@PHP2JS_FRAMEWORK() 

// Con Alias **RECOMENDADO**
@PHP2JS_FRAMEWORK('MiAlias')
```

Esto le compartirá a JavaScript los siguientes datos:
```javascript
PHP2JS = {
    framework: {
        version:        // Versión de Laravel en Uso
        environment: {
            name:       // Nombre de la aplicación desde el ENV
            debug:      // Estado del Debugger de la aplicación.
            context:    // Ambiente en el que se ejecuta de acuerdo al ENV
            url:        // URL de la aplicación puesta en el ENV
        }
    }
}
```

### Compartir Información De PHP.
Esta directiva permite conocer algunos datos inherentes a la versión de PHP en USO. Esta directiva puede ser empleada para sistemas donde se permite el uso de múltiples versiones de PHP. Solo úsala si realmente le tienes un uso.

```php
// Sin Alias
@PHP2JS_PHP() 

// Con Alias **RECOMENDADO**
@PHP2JS_PHP('MiAlias')
```

Esto le compartirá a JavaScript los siguientes datos:
```javascript
PHP2JS = {
    php : {
        id:                     // Versión ID de PHP
        version:                // Versión en uso de PHP
        release:                // Release Actual de PHP
        serverSoftware:         // Software del servidor web que está ejecutando el script actual
        serverOperatingSystem:  // Sistema Operativo Sobre el Cual Corre PHP
        extensions:             // Extensiones habilitadas de PHP
        clientLanguage:         // Lenguaje Habilitado del Cliente
    }
}
```

### Compartir Información Del Usuario En Sesión.
Esta directiva permite compartir los datos del usuario en sesión con JavaScript. Pensamos en dejarla por defecto, porque siempre los usuarios de la plataforma la emplean, sin embargo, preferimos que esté a tu discreción. Tendrás los datos del usuario en sesión en JavaScript, ¡calma!, el ID del usuario en la base de datos e información sensible no se mostrará. El ID lo tendrás encriptado por el método Crypt::encrypt() de Laravel.

```php
// Sin Alias
@PHP2JS_USER() 

// Con Alias **RECOMENDADO**
@PHP2JS_USER('MiAlias')
```

Esto le compartirá a JavaScript los siguientes datos:
```javascript
PHP2JS = {
    user : {
        id:                     // Id Encriptado
        email:                  // Correo electrónico
        ...                     // Todos los demás datos no sensibles.
    }
}
```

### Compartir Variables Existentes en PHP con JavaScript.
La directiva principal de la Biblioteca. Te permite compartir con JavaScript todas las variables existentes en PHP. Esto significa que le pasarás a JavaScript los valores retornados por el controlador, así como los valores de las variables que hayas creado en la vista Blade. ¡Así es! Si has definido bucles y demás sentencias en el Front

, todo esto lo tendrás a la mano en JavaScript. Esto sí que es útil.

```php
// Sin Alias
@PHP2JS_VARS() 

// Con Alias **RECOMENDADO**
@PHP2JS_VARS('MiAlias')
```

Esto le compartirá a JavaScript los siguientes datos:
```javascript
PHP2JS = {
    ...:    // Bueno aquí pueden existir cualquier valor, esto depende de las variables existentes en PHP
}
```

### Compartir Solo Algunas Variables Existentes en PHP con JavaScript.
La segunda directiva principal de la Biblioteca. Te permite compartir con JavaScript solo algunas variables existentes en PHP. Esto significa que le pasarás a JavaScript los valores controlados que requieras. Esto es más que útil, seguro, podrás pasar solo algunos datos, evitando pasar al tiempo de ejecución de JavaScript más valores de los necesarios.

```php
// Sin Alias
@PHP2JS_VARS_STRICT(['variable1','variable2'])

// Con Alias **RECOMENDADO**
@PHP2JS_VARS_STRICT(['variable1','variable2'], 'MiAlias')
```

Esto le compartirá a JavaScript los siguientes datos:
```javascript
PHP2JS = {
    ...:    // Bueno aquí pueden existir cualquier valor, esto depende de las variables existentes que pases desde PHP
}
```

## Métodos en JavaScript

No solo tendrás los datos transmitidos desde PHP en el entorno de JavaScript. Además de los valores, el objeto que es pasado desde PHP te ofrecerá algunos métodos que serán de gran ayuda. Estamos seguros de que descubrirás por tu cuenta cuándo usar cada uno.

### Limpiar (Clear)
El método `.clear()` vaciará el objeto entregado por PHP a JavaScript. Esto será útil cuando desees que los valores no sean accesibles desde las diferentes referencias del objeto.

```javascript
// Vaciar El Objeto (Todas las referencias del Objeto perderán los valores)
// Recuerda que PHP2JS debe ser cambiado por el Alias que hayas usado.
PHP2JS.clear();
```

### Limpiar Sin Funciones (clearWithoutFunctions)
El método `.clearWithoutFunctions()` vaciará las variables del objeto entregado por PHP a JavaScript. Pero no eliminará los métodos que se están listando en este apartado. Esto será útil cuando desees que los valores no sean accesibles desde las diferentes referencias del objeto.

```javascript
// Vaciar El Objeto (Todas las referencias del Objeto perderán los valores pero las funciones seguirán existiendo)
// Recuerda que PHP2JS debe ser cambiado por el Alias que hayas usado.
PHP2JS.clearWithoutFunctions();
```

### Asignar (assign)
El método `.assign()` le asigna a una nueva variable o constante los mismos valores del Objeto entregado por PHP. Ahora podrás eliminar el objeto original sin perder los valores que dejas en el nuevo. Esto será útil cuando desees que los valores no sean accesibles desde las diferentes referencias del objeto original y en su lugar usar un objeto en tiempo de ejecución de JavaScript.

```javascript
// Asignar una copia del objeto a una nueva variable en tiempo de ejecución.
// Recuerda que PHP2JS debe ser cambiado por el Alias que hayas usado.
const phpData = PHP2JS.assign();

// Aquí podrías vaciar el objeto original.
PHP2JS.clear();

// Los valores ahora estarán en "phpData"
```

### Asignar Y Limpiar (assignAndClear)
El método `.assignAndClear()` le asigna a una nueva variable o constante los mismos valores del Objeto entregado por PHP y adicional borra el elemento original. Esto será útil cuando desees que los valores no sean accesibles desde las diferentes referencias del objeto original y en su lugar usar un objeto en tiempo de ejecución de JavaScript.

```javascript
// Vaciar El Objeto (Todas las referencias del Objeto perderán los valores dejando una copia en tiempo de ejecución dentro de otra variable o constante)
// Recuerda que PHP2JS debe ser cambiado por el Alias que hayas usado.
const phpData = PHP2JS.assignAndClear();
// Los valores ahora estarán en "phpData"
```

### Asignar Y Limpiar Sin Funciones (assignAndClearWithoutFunctions)
El método `.assignAndClearWithoutFunctions()` le asigna a una nueva variable o constante los mismos valores del Objeto entregado por PHP y adicional borra del elemento original los valores pero no las funciones o métodos. Esto será útil cuando desees que los valores no sean accesibles desde las diferentes referencias del objeto original y en su lugar usar un objeto en tiempo de ejecución de JavaScript.

```javascript
// Vaciar El Objeto (Todas las referencias del Objeto perderán los valores sin eliminar las funciones o métodos.)
// Recuerda que PHP2JS debe ser cambiado por el Alias que hayas usado.
const phpData = PHP2JS.assignAndClearWithoutFunctions();
// Los valores ahora estarán en "phpData" y en "PHP2JS" seguirán existiendo los métodos del objeto.
```

### Solo (only)
El método `.only(...props)` permite extraer la información del objeto entregado por PHP de los valores que se requieran. Como parámetros, podrás definir qué valores realmente necesitas. Esto será útil cuando no desees cargar todo el contenido de la constante.

```javascript
// Consulta solo los datos pasados como argumentos en el método Only
// Recuerda que PHP2JS debe ser cambiado por el Alias que hayas usado.
const post = PHP2JS.only('post');
```

### Solo Funciones (onlyFunctions)
El método `.onlyFunctions()` permite extraer la información de las funciones existentes en el objeto entregado por PHP a JavaScript.

```javascript
// Consulta solo los métodos o funciones del objeto entregado por PHP a JavaScript.
// Recuerda que PHP2JS debe ser cambiado por el Alias que hayas usado.
const functions = PHP2JS.onlyFunctions();
```

### Excepto (except)
El método `.except(...props)` permite extraer la

 información del objeto entregado por PHP de los valores que no se requieran. Como parámetros, podrás definir qué valores no deseas que se tengan en cuenta. Esto será útil cuando no desees cargar todo el contenido de la constante.

```javascript
// Consulta solo los datos que requiera exceptuando otros.
// Recuerda que PHP2JS debe ser cambiado por el Alias que hayas usado.
const withoutNews = PHP2JS.except('news');
```

### Excepto Funciones (exceptFunctions)
El método `.exceptFunctions()` permite extraer la información de las variables y bloques de código preconstruidos exceptuando los métodos y funciones.

```javascript
// Consulta solo los valores del objeto entregado por PHP a JavaScript.
// Recuerda que PHP2JS debe ser cambiado por el Alias que hayas usado.
const functions = PHP2JS.exceptFunctions();
```

### Validar Si Existe Propiedad (hasProperty)
El método `.hasProperty()` permite saber si una propiedad existe dentro del objeto. El retorno será verdadero o falso según sea el caso.

```javascript
// Consulta solo los valores del objeto entregado por PHP a JavaScript.
// Recuerda que PHP2JS debe ser cambiado por el Alias que hayas usado.
const existPost = PHP2JS.hasProperty('post'); // true // false
```

### Obtener Todas Las Propiedades (getAllProperties)
El método `.getAllProperties()` permite obtener un arreglo con todas las propiedades que tiene el objeto.

```javascript
// Consulta en un arreglo todas las propiedades del objeto.
// Recuerda que PHP2JS debe ser cambiado por el Alias que hayas usado.
const existPost = PHP2JS.getAllProperties(); 
```

### Asignar (set)
El método `.set('prop','value')` permite asignar un nuevo valor a una propiedad existente del objeto. Si deseas actualizar, reemplazar o asignar nuevos valores a una propiedad del objeto, podrás hacerlo fácilmente.

```javascript
// En este ejemplo pondremos en la propiedad "Cuenta" el valor de 0;
// Recuerda que PHP2JS debe ser cambiado por el Alias que hayas usado.
PHP2JS.set("cuenta", 0); 
```

### Obtener (get)
El método `.get('prop')` permite obtener una propiedad en específico del objeto. Retorna solo la propiedad consultada.

```javascript
// En este ejemplo consultaremos solo el valor de "Cuenta" dentro del objeto entregado por PHP a JavaScript.
// Recuerda que PHP2JS debe ser cambiado por el Alias que hayas usado.
PHP2JS.get("cuenta"); 
```

El poder está a tu alcance. ¡Mucho éxito en tus proyectos!

## Creador
- 🇨🇴 Raúl Mauricio Uñate Castro
- Correo electrónico: raulmauriciounate@gmail.com

## Desarrolladores
- 🇨🇴 Carlos Giovanni Rodriguez (musica_tuto@hotmail.com)
- 🇨🇴 Laura Valentina Borda Vargas (lvalentina0507@gmail.com)
- 🇨🇴 Wilmer A. Sanchez Saez (wilmersaz@hotmail.com)
- 🇨🇴 John Alejandro Diaz Pinilla (diazjohn83@gmail.com)
- 🇨🇴 Jorge Hernan Castañeda (ds.jorgecastaneda@gmail.com)
- 🇲🇽 Julio C. Borges (julio-borgeslopez@outlook.com)

## Licencia
Este proyecto se encuentra bajo la [Licencia MIT](https://choosealicense.com/licenses/mit/).

🌟 ¡Apoya Mis Proyectos! 🚀

¡Realiza las contribuciones que veas necesarias, el código es totalmente tuyo. Juntos podemos hacer cosas asombrosas y mejorar el mundo del desarrollo. Tu apoyo es invaluable. ✨

Si tienes ideas, sugerencias o simplemente deseas colaborar, ¡estamos abiertos a todo! ¡Únete a nuestra comunidad y forma parte de nuestro viaje hacia el éxito! 🌐👩‍💻👨‍💻
