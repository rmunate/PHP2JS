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

class PHP2JSServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(){

        /**
         * Iqual ->toJS()
         * @return BladeDirective
         */
        Blade::directive('toJS', function ($expression) {
            $script = '<script id="_X2JS_MAIN">
                const _MAIN_XTOJS = {
                    vars: <?php echo json_encode(array_diff_key(get_defined_vars(), array_flip(["app", "__data", "errors", "__env", "__path"]))); ?>,
                    url: <?php echo json_encode(\Rmunate\Php2Js\DataPhp2Js::getDataUrl()); ?>,
                    csrf: <?php echo json_encode(\Rmunate\Php2Js\DataPhp2Js::getDataCSRF()); ?>,
                };
            </script>
            <script id="_X2JS_DOM">
                setTimeout(() => {
                    document.getElementById("_X2JS_MAIN").remove();
                    document.getElementById("_X2JS_DOM").remove();
                }, 500);
            </script>';
                    
            if (!empty($expression)) {
                $script = str_replace('_MAIN_XTOJS', str_replace(['"', "'"],"",$expression), $script);
            } else {
                $script = str_replace('_MAIN_XTOJS','PHP2JS',$script);
            }
        
            return $script;
        });

        /**
         * Iqual ->toAllJS()
         * @return BladeDirective
         */
        Blade::directive('toAllJS', function ($expression) {
            $script = '<script id="_X2JS_MAIN">
                const _MAIN_XTOJS = {
                    vars: <?php echo json_encode(array_diff_key(get_defined_vars(), array_flip(["app", "__data", "errors", "__env", "__path"]))); ?>,
                    url: <?php echo json_encode(\Rmunate\Php2Js\DataPhp2Js::getDataUrl()); ?>,
                    csrf: <?php echo json_encode(\Rmunate\Php2Js\DataPhp2Js::getDataCSRF()); ?>,
                    php: <?php echo json_encode(\Rmunate\Php2Js\DataPhp2Js::getDataPHP()); ?>,
                    laravel: <?php echo json_encode(\Rmunate\Php2Js\DataPhp2Js::getDataLaravel(), JSON_PRETTY_PRINT); ?>,
                    user: <?php echo json_encode(\Rmunate\Php2Js\DataPhp2Js::getDataUser()); ?>,
                    agent: <?php echo json_encode(\Rmunate\Php2Js\DataPhp2Js::getDataAgent()); ?>,
                };
            </script>
            <script id="_X2JS_DOM">
                setTimeout(() => {
                    document.getElementById("_X2JS_MAIN").remove();
                    document.getElementById("_X2JS_DOM").remove();
                }, 500);
            </script>';
                    
            if (!empty($expression)) {
                $script = str_replace('_MAIN_XTOJS', str_replace(['"', "'"],"",$expression), $script);
            } else {
                $script = str_replace('_MAIN_XTOJS','PHP2JS',$script);
            }
        
            return $script;
        });

        /**
         * Iqual ->toStrictJS()
         * @return BladeDirective
         */
        Blade::directive('toStrictJS', function ($expression) {
            $script = '<script id="_X2JS_MAIN">
                const _MAIN_XTOJS = {
                    vars: <?php echo json_encode(array_diff_key(get_defined_vars(), array_flip(["app", "__data", "errors", "__env", "__path"]))); ?>,
                };
            </script>
            <script id="_X2JS_DOM">
                setTimeout(() => {
                    document.getElementById("_X2JS_MAIN").remove();
                    document.getElementById("_X2JS_DOM").remove();
                }, 500);
            </script>';
                    
            if (!empty($expression)) {
                $script = str_replace('_MAIN_XTOJS', str_replace(['"', "'"],"",$expression), $script);
            } else {
                $script = str_replace('_MAIN_XTOJS','PHP2JS',$script);
            }
        
            return $script;
        });


    }
}
