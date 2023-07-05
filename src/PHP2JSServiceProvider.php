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
     * Create Blade Directives.
     *
     * @return void
     */
    public function boot()
    {
        //-------------------------------------------------------------------#
        //-                         NEW STANDAR USE                         -#
        //-------------------------------------------------------------------#

        /**
         * 🚀 PHP2JS_AGENT
         * Info From The Agent PHP.
         *
         * @return BladeDirective
         */
        Blade::directive('PHP2JS_AGENT', function ($expression) {
            return JS::script('getDataAgent')->alias($expression)->generate();
        });

        /**
         * 🚀 PHP2JS_URL
         * Info From The URL in use.
         *
         * @return BladeDirective
         */
        Blade::directive('PHP2JS_URL', function ($expression) {
            return JS::script('getDataUrl')->alias($expression)->generate();
        });

        /**
         * 🚀 PHP2JS_CSRF
         * Token For Laravel.
         *
         * @return BladeDirective
         */
        Blade::directive('PHP2JS_CSRF', function ($expression) {
            return JS::script('getDataCSRF')->alias($expression)->generate();
        });

        /**
         * 🚀 PHP2JS_FRAMEWORK
         * Info From Laravel Framework.
         *
         * @return BladeDirective
         */
        Blade::directive('PHP2JS_FRAMEWORK', function ($expression) {
            return JS::script('getDataLaravel')->alias($expression)->generate();
        });

        /**
         * 🚀 PHP2JS_PHP
         * Info From Laravel Framework.
         *
         * @return BladeDirective
         */
        Blade::directive('PHP2JS_PHP', function ($expression) {
            return JS::script('getDataPHP')->alias($expression)->generate();
        });

        /**
         * 🚀 PHP2JS_USER
         * Info From Laravel Framework.
         *
         * @return BladeDirective
         */
        Blade::directive('PHP2JS_USER', function ($expression) {
            return JS::script('getDataUser')->alias($expression)->generate();
        });

        /**
         * 🚀 BRIDGE VARS
         * Pass variables from PHP to JavaScript.
         *
         * @return BladeDirective
         */
        Blade::directive('PHP2JS_VARS', function ($expression) {
            return JS::script('vars')->alias($expression)->generate();
        });

        /**
         * 🚀 STRICT VARS
         * Pass strict variables from PHP to JavaScript.
         *
         * @return BladeDirective
         */
        Blade::directive('PHP2JS_VARS_STRICT', function ($expression) {
            if (!empty($expression)) {
                /* Vaciar Espacios */
                $params = str_replace(' ', '', $expression);

                /* Validar Variables a Retornar */
                if (strpos($params, '[]') !== false) {
                    /* Optener el Alias */
                    $alias = str_replace('[],', '', $expression);
                    /* Retornar todas las variables */
                    return JS::script('vars')->alias($alias)->generate();
                } elseif ((strpos($params, '[') !== false) && (strpos($params, ']') !== false)) {
                    $posicionInicio = strpos($expression, '[');
                    $posicionFin = strpos($expression, ']');

                    $compact = substr($expression, $posicionInicio, $posicionFin + 1);
                    $alias = substr($expression, $posicionFin + 2);

                    return JS::compact($compact)->alias($alias)->generate();
                }
            }

            throw new \Exception("Directive exception '@PHP2JS_VARS_STRICT()', it is required to define the variables to share with JavaScript ['variable1','variable2',...], in case you do not want to specify which variables to share you can choose to use the directive '@PHP2JS_VARS()' manual 'https://github.com/rmunate/PHP2JS'");
        });

        //-------------------------------------------------------------------#
        //-                      VERSIONS 3.0.0 - 3.4.9                     -#
        //-               Directivas Suprimidas en la version               -#
        //-------------------------------------------------------------------#

        Blade::directive('toJS', function ($expression) {
            throw new \Exception("The 'toJS' directive was removed from the library due to a process of standardization of use. You can replace it as needed according to the new standard 'https://github.com/rmunate/PHP2JS'");
        });

        Blade::directive('toAllJS', function ($expression) {
            throw new \Exception("The 'toAllJS' directive was removed from the library due to a process of standardization of use. You can replace it as needed according to the new standard 'https://github.com/rmunate/PHP2JS'");
        });

        Blade::directive('toStrictJS', function ($expression) {
            throw new \Exception("The 'toStrictJS' directive was removed from the library due to a process of standardization of use. You can replace it as needed according to the new standard 'https://github.com/rmunate/PHP2JS'");
        });

        //-------------------------------------------------------------------#
        //-                      VERSIONS  inferiores 3.0                   -#
        //-               Directivas De la Version 6 Hacia Atras            -#
        //-------------------------------------------------------------------#

        Blade::directive('__PHP', function () {
            return '<script id="__PHP2JS_PRIVATE">sessionStorage.clear();unique_php2js = Math.random().toString(16).slice(2);var bridgePHP={get_defined_vars:unique_php2js+"_vars",baseUrl:unique_php2js+"_baseUrl",fullUrl:unique_php2js+"_fullUrl",parameters:unique_php2js+"_parameters",uri:unique_php2js+"_uri",scheme:unique_php2js+"_scheme",token:unique_php2js+"_token",tokenMeta:unique_php2js+"_tokenMeta",tokenInput:unique_php2js+"_tokenInput",agent:unique_php2js+"_agent",remote_ip:unique_php2js+"_remote_ip",remote_port:unique_php2js+"_remote_port",php_version:unique_php2js+"_php_version",php_id:unique_php2js+"_php_id",php_release:unique_php2js+"_php_release",browser:unique_php2js+"_browser",is_mobile:unique_php2js+"_is_mobile",mobile_os_android:unique_php2js+"_mobile_os_android",mobile_os_iphone:unique_php2js+"_mobile_os_iphone",os_linux:unique_php2js+"_os_linux",os_ios:unique_php2js+"_os_ios",os_windows:unique_php2js+"_os_windows",user:unique_php2js+"_user",debugger:unique_php2js+"_debugger"};delete unique_php2js;sessionStorage.setItem(bridgePHP.get_defined_vars, JSON.stringify(<?php echo json_encode(array_diff_key(get_defined_vars(), array_flip(["app", "__data", "errors", "__env", "__path"]))); ?>));sessionStorage.setItem(bridgePHP.baseUrl, <?php echo json_encode(url("/")); ?>);sessionStorage.setItem(bridgePHP.fullUrl, <?php echo json_encode(Illuminate\Support\Facades\Request::fullUrl()); ?>);sessionStorage.setItem(bridgePHP.parameters, JSON.stringify(<?php echo json_encode(Illuminate\Support\Facades\Route::current()); ?>.parameters));sessionStorage.setItem(bridgePHP.uri, <?php echo json_encode(Illuminate\Support\Facades\Route::current()); ?>.uri);sessionStorage.setItem(bridgePHP.scheme, <?php echo json_encode(\Rmunate\InfoServer\Server::server_protocol()); ?>);sessionStorage.setItem(bridgePHP.token, <?php echo json_encode(csrf_token()); ?>);sessionStorage.setItem(bridgePHP.tokenMeta, "<meta name=" + String.fromCharCode(34) + " csrf-token" + String.fromCharCode(34) + " content=" + String.fromCharCode(34) + sessionStorage.getItem(bridgePHP.token) + String.fromCharCode(34) + ">");sessionStorage.setItem(bridgePHP.tokenInput, "<input type" + String.fromCharCode(34) + "hidden" + String.fromCharCode(34) + " name=" + String.fromCharCode(34) + "_token" + String.fromCharCode(34) + " value=" + String.fromCharCode(34) + sessionStorage.getItem(bridgePHP.token) + String.fromCharCode(34) + "/>");sessionStorage.setItem(bridgePHP.php_version, <?php echo json_encode(\Rmunate\InfoServer\Server::php_version()); ?>);sessionStorage.setItem(bridgePHP.php_id, <?php echo json_encode(\Rmunate\InfoServer\Server::php_version_id()); ?>);sessionStorage.setItem(bridgePHP.php_release, <?php echo json_encode(\Rmunate\InfoServer\Server::php_release_version()); ?>);sessionStorage.setItem(bridgePHP.agent, <?php echo json_encode(\Rmunate\InfoServer\Server::agent()->get()->http_user_agent); ?>);sessionStorage.setItem(bridgePHP.remote_ip, <?php echo json_encode(\Rmunate\InfoServer\Server::remote_addr()); ?>);sessionStorage.setItem(bridgePHP.remote_port, <?php echo json_encode(\Rmunate\InfoServer\Server::remote_port()); ?>);sessionStorage.setItem(bridgePHP.browser, JSON.stringify(<?php echo json_encode(\Rmunate\InfoServer\Server::agent()->browser()); ?>));sessionStorage.setItem(bridgePHP.is_mobile, <?php echo json_encode(\Rmunate\InfoServer\Server::agent()->is_Mobile()); ?>);sessionStorage.setItem(bridgePHP.mobile_os_android, <?php echo json_encode(\Rmunate\InfoServer\Server::agent()->is_Android()); ?>);sessionStorage.setItem(bridgePHP.mobile_os_iphone, <?php echo json_encode(\Rmunate\InfoServer\Server::agent()->is_iPhone()); ?>);sessionStorage.setItem(bridgePHP.os_linux, <?php echo json_encode(\Rmunate\InfoServer\Server::agent()->is_Linux()); ?>);sessionStorage.setItem(bridgePHP.os_ios, <?php echo json_encode(\Rmunate\InfoServer\Server::agent()->is_Macintosh()); ?>);sessionStorage.setItem(bridgePHP.os_windows, <?php echo json_encode(\Rmunate\InfoServer\Server::agent()->is_Windows()); ?>);sessionStorage.setItem(bridgePHP.user, JSON.stringify(<?php if(!empty(\Illuminate\Support\Facades\Auth::user())){$usrx = array_diff_key(\Illuminate\Support\Facades\Auth::user()->toArray(),array_flip(["created_at","updated_at","email_verified_at"]));$usrx["id"] = \Illuminate\Support\Facades\Crypt::encrypt($usrx["id"]);echo json_encode($usrx);} else { echo json_encode([]);}?>));sessionStorage.setItem(bridgePHP.debugger, <?php echo json_encode(env("APP_DEBUG")); ?>);</script><script id="__PHP2JS_CLASS">class PHP{#a;#b;#c;#d;#e;#f;#g;#h;#i;#j;#k;#l;#m;#n;#o;#p;#q;#r;#s;#t;#u;#v;#w;#x;constructor(){this.#a=PHP.item(bridgePHP.get_defined_vars),this.#b=PHP.item(bridgePHP.baseUrl),this.#c=PHP.item(bridgePHP.fullUrl),this.#d=PHP.item(bridgePHP.parameters),this.#e=PHP.item(bridgePHP.uri),this.#f=PHP.item(bridgePHP.scheme),this.#g=PHP.item(bridgePHP.token),this.#h=PHP.item(bridgePHP.tokenMeta),this.#i=PHP.item(bridgePHP.tokenInput),this.#j=PHP.item(bridgePHP.php_version),this.#k=PHP.item(bridgePHP.php_id),this.#l=PHP.item(bridgePHP.php_release),this.#m=PHP.item(bridgePHP.agent),this.#n=PHP.item(bridgePHP.remote_ip),this.#o=PHP.item(bridgePHP.remote_port),this.#p=PHP.item(bridgePHP.browser),this.#q="true"===PHP.item(bridgePHP.is_mobile),this.#r="true"===PHP.item(bridgePHP.mobile_os_android),this.#s="true"===PHP.item(bridgePHP.mobile_os_iphone),this.#t="true"===PHP.item(bridgePHP.os_linux),this.#u="true"===PHP.item(bridgePHP.os_ios),this.#v="true"===PHP.item(bridgePHP.os_windows),this.#w=PHP.item(bridgePHP.user),this.#x="true"===PHP.item(bridgePHP.debugger),__eventSafeDataPHP2JS()}groups(){return{vars:this.#a,url:{baseUrl:this.#b,fullUrl:this.#c,parameters:this.#d,uri:this.#e,scheme:this.#f},token:{value:this.#g,meta:this.#h,input:this.#i},php:{version:this.#j,id:this.#k,release:this.#l},agent:{value:this.#m,remote_ip:this.#n,remote_port:this.#o,browser:this.#p,is_mobile:this.#q,mobile_os:{android:this.#r,iphone:this.#s},os:{linux:this.#t,ios:this.#u,windows:this.#v}},user:this.#w,debug:this.#x}}all(){return{vars:this.#a,baseUrl:this.#b,fullUrl:this.#c,parameters:this.#d,uri:this.#e,scheme:this.#f,token:this.#g,tokenMeta:this.#h,tokenInput:this.#i,php_version:this.#j,php_id:this.#k,php_release:this.#l,agent:this.#m,remote_ip:this.#n,remote_port:this.#o,browser:this.#p,is_mobile:this.#q,mobile_os_android:this.#r,mobile_os_iphone:this.#s,os_linux:this.#t,os_ios:this.#u,os_windows:this.#v,user:this.#w,debug:this.#x}}vars(){return this.#a}baseUrl(){return this.#b}fullUrl(){return this.#c}parameters(){return this.#d}uri(){return this.#e}scheme(){return this.#f}token(){return this.#g}tokenMeta(){return this.#h}tokenInput(){return this.#i}php_version(){return this.#j}php_id(){return this.#k}php_release(){return this.#l}agent(){return this.#m}remote_ip(){return this.#n}remote_port(){return this.#o}browser(){return this.#p}is_mobile(){return this.#q}mobile_os_android(){return this.#r}mobile_os_iphone(){return this.#s}os_linux(){return this.#t}os_ios(){return this.#u}os_windows(){return this.#v}user(){return this.#w}debug(){return this.#x}static item(e){return __getDataItemPHP2JS(e)}}</script><script id="__PHP2JS_FUNCTION_S">function __getDataItemPHP2JS(e){let t=sessionStorage.getItem(e);return[bridgePHP.get_defined_vars,bridgePHP.parameters,bridgePHP.user,bridgePHP.browser].includes(e)?JSON.parse(t):t}function __eventSafeDataPHP2JS(){"true"!==PHP.item(bridgePHP.debugger)&&setTimeout(()=>{console.clear()},50)}function __PHP(){return new PHP}</script><script id="__PHP2JS_CONST">const $PHP=__PHP().all(),$PHP_GROUPS=__PHP().groups(),$PHP_VARS=__PHP().vars(),$PHP_BASE_URL=__PHP().baseUrl(),$PHP_FULL_URL=__PHP().fullUrl(),$PHP_PARAMETERS=__PHP().parameters(),$PHP_URI=__PHP().uri(),$PHP_SCHEME=__PHP().scheme(),$PHP_TOKEN=__PHP().token(),$PHP_TOKEN_META=__PHP().tokenMeta(),$PHP_TOKEN_INPUT=__PHP().tokenInput(),$PHP_VERSION=__PHP().php_version(),$PHP_ID=__PHP().php_id(),$PHP_RELEASE=__PHP().php_release(),$PHP_AGENT=__PHP().agent(),$PHP_AGENT_REMOTE_IP=__PHP().remote_ip(),$PHP_AGENT_REMOTE_PORT=__PHP().remote_port(),$PHP_AGENT_BROWSER=__PHP().browser(),$PHP_AGENT_IS_MOBILE=__PHP().is_mobile(),$PHP_AGENT_MOBILE_OS_ANDROID=__PHP().mobile_os_android(),$PHP_AGENT_MOBILE_OS_IPHONE=__PHP().mobile_os_iphone(),$PHP_AGENT_OS_LINUX=__PHP().os_linux(),$PHP_AGENT_OS_IOS=__PHP().os_ios(),$PHP_AGENT_OS_WINDOWS=__PHP().os_windows(),$PHP_USER=__PHP().user(),$PHP_DEBUG=__PHP().debug();</script><script id="__PHP2JS_REMOVE">setTimeout(()=>{document.getElementById("__PHP2JS_PRIVATE").remove(),document.getElementById("__PHP2JS_CLASS").remove(),document.getElementById("__PHP2JS_FUNCTION_S").remove(),document.getElementById("__PHP2JS_CONST").remove(),document.getElementById("__PHP2JS_REMOVE").remove()},500);</script>';
        });

        // Blade::directive('__PHP', function ($expression) {
        //     throw new \Exception("The '__PHP' directive is not available in this version of the library, its use is available on version ^2.6, you can choose to downgrade to version 'rmunate/php2js: ^2.6' in 'composer.json' and then run 'composer update', or replace it with the directives of the current version 'https://github.com/rmunate/PHP2JS'");
        // });
    }
}
