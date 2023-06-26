<?php

/*
 * Copyright (c) [2023] [RAUL MAURICIO UÑATE CASTRO]
 * https://github.com/rmunate/PHP2JS
 *
 * Esta biblioteca es un software de código abierto disponible bajo la licencia MIT.
 * Se concede permiso, de forma gratuita, a cualquier persona que obtenga una copia de esta biblioteca y los archivos de
 * documentación asociados (el "Software"), para utilizar la biblioteca sin restricciones, incluyendo, entre otras, las
 * siguientes acciones:
 *
 * - Utilizar la biblioteca con fines comerciales o no comerciales.
 * - Modificar la biblioteca y adaptarla a sus propias necesidadeess.
 * - Distribuir copias de la biblioteca.
 * - Sublicenciar la biblioteca.
 *
 * Al utilizar o distribuir esta biblioteca, se requiere que se incluya la siguiente atribución en todas las copias o
 * partes sustanciales de la misma:
 *
 * "[RAUL MAURICIO UÑATE CASTRO], titular de los derechos de autor de esta biblioteca, debe ser
 * reconocido y mencionado en todas las copias o derivados de la biblioteca."
 *
 * Además, si se realizan modificaciones en la biblioteca, se solicita que se incluya una nota adicional en la
 * documentación o en cualquier otro medio de notificación de los cambios realizados, que indique:
 *
 * "Esta biblioteca se ha modificado a partir de la biblioteca original desarrollada por [RAUL MAURICIO UÑATE CASTRO]."
 *
 * LA BIBLIOTECA SE PROPORCIONA "TAL CUAL", SIN GARANTÍA DE NINGÚN TIPO, EXPRESA O IMPLÍCITA, INCLUYENDO PERO NO
 * LIMITADO A GARANTÍAS DE COMERCIALIZACIÓN, ADECUACIÓN PARA UN PROPÓSITO PARTICULAR Y NO INFRACCIÓN. EN NINGÚN CASO
 * LOS AUTORES O TITULARES DE LOS DERECHOS DE AUTOR SERÁN RESPONSABLES DE NINGUNA RECLAMACIÓN, DAÑO O OTRA
 * RESPONSABILIDAD, YA SEA EN UNA ACCIÓN DE CONTRATO, AGRAVIO O CUALQUIER OTRO MOTIVO, QUE SURJA DE, O EN RELACIÓN CON
 * LA BIBLIOTECA O EL USO U OTROS TRATOS EN LA BIBLIOTECA.
 */

namespace Rmunate\Php2Js;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Rmunate\Php2Js\JS;

class PHP2JSServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //....
    }

    /**
     * Create Blade Directives
     * @return Void
     */
    public function boot()
    {

        #-------------------------------------------------------------------#
        #-                         NEW STANDAR USE                         -#
        #-------------------------------------------------------------------#

        /**
         * 🚀 PHP2JS_AGENT
         * Info From The Agent PHP
         * @return BladeDirective
         */
        Blade::directive('PHP2JS_AGENT', function ($expression) {
            return JS::script('getDataAgent')->alias($expression)->generate();
        });

        /**
         * 🚀 PHP2JS_URL
         * Info From The URL in use
         * @return BladeDirective
         */
        Blade::directive('PHP2JS_URL', function ($expression) {
            return JS::script('getDataUrl')->alias($expression)->generate();
        });

        /**
         * 🚀 PHP2JS_CSRF
         * Token For Laravel
         * @return BladeDirective
         */
        Blade::directive('PHP2JS_CSRF', function ($expression) {
            return JS::script('getDataCSRF')->alias($expression)->generate();
        });

        /**
         * 🚀 PHP2JS_FRAMEWORK
         * Info From Laravel Framework
         * @return BladeDirective
         */
        Blade::directive('PHP2JS_FRAMEWORK', function ($expression) {
            return JS::script('getDataLaravel')->alias($expression)->generate();
        });

        /**
         * 🚀 PHP2JS_PHP
         * Info From Laravel Framework
         * @return BladeDirective
         */
        Blade::directive('PHP2JS_PHP', function ($expression) {
            return JS::script('getDataPHP')->alias($expression)->generate();
        });

        /**
         * 🚀 PHP2JS_USER
         * Info From Laravel Framework
         * @return BladeDirective
         */
        Blade::directive('PHP2JS_USER', function ($expression) {
            return JS::script('getDataUser')->alias($expression)->generate();
        });

        /**
         * 🚀 BRIDGE VARS
         * Pass variables from PHP to JavaScript
         * @return BladeDirective
         */
        Blade::directive('PHP2JS_VARS', function ($expression) {
            return JS::script('vars')->alias($expression)->generate();
        });

        /**
         * 🚀 STRICT VARS
         * Pass strict variables from PHP to JavaScript
         * @return BladeDirective
         */
        Blade::directive('PHP2JS_VARS_STRICT', function ($expression) {

            if (!empty($expression)) {

                /* Vaciar Espacios */
                $params = str_replace(" ", "", $expression);

                /* Validar Variables a Retornar */
                if (strpos($params, '[]') !== false) {

                    /* Optener el Alias */
                    $alias = str_replace("[],", "", $expression);
                    /* Retornar todas las variables */
                    return JS::script('vars')->alias($alias)->generate();

                } else if ((strpos($params, '[') !== false) && (strpos($params, ']') !== false)) {

                    $posicionInicio = strpos($expression, "[");
                    $posicionFin = strpos($expression, "]");

                    $compact = substr($expression, $posicionInicio, $posicionFin + 1);
                    $alias = substr($expression, $posicionFin + 2);

                    return JS::compact($compact)->alias($alias)->generate();
                }
            }

            throw new \Exception ("Directive exception '@PHP2JS_VARS_STRICT()', it is required to define the variables to share with JavaScript ['variable1','variable2',...], in case you do not want to specify which variables to share you can choose to use the directive '@PHP2JS_VARS()' manual 'https://github.com/rmunate/PHP2JS'");

        });

        #-------------------------------------------------------------------#
        #-                      VERSIONS 3.0.0 - 3.4.9                     -#
        #-               Directivas Suprimidas en la version               -#
        #-------------------------------------------------------------------#

        Blade::directive('toJS', function ($expression) {
            throw new \Exception ("The 'toJS' directive was removed from the library due to a process of standardization of use. You can replace it as needed according to the new standard 'https://github.com/rmunate/PHP2JS'");
        });

        Blade::directive('toAllJS', function ($expression) {
            throw new \Exception ("The 'toAllJS' directive was removed from the library due to a process of standardization of use. You can replace it as needed according to the new standard 'https://github.com/rmunate/PHP2JS'");
        });

        Blade::directive('toStrictJS', function ($expression) {
            throw new \Exception ("The 'toStrictJS' directive was removed from the library due to a process of standardization of use. You can replace it as needed according to the new standard 'https://github.com/rmunate/PHP2JS'");
        });

        #-------------------------------------------------------------------#
        #-                      VERSIONS  inferiores 3.0                   -#
        #-               Directivas Suprimidas en la version               -#
        #-------------------------------------------------------------------#

        Blade::directive('__PHP', function ($expression) {
            throw new \Exception ("The '__PHP' directive is not available in this version of the library, its use is available on version ^2.6, you can choose to downgrade to version 'rmunate/php2js: ^2.6' in 'composer.json' and then run 'composer update', or replace it with the directives of the current version 'https://github.com/rmunate/PHP2JS'");
        });

    }
}
