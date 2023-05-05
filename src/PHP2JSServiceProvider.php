<?php

namespace Rmunate\Php2Js;

/*
|--------------------------------------------------------------------------
| Envio de variables de PHP a JS en vistas Blade
|--------------------------------------------------------------------------
| Autor: Raul Mauricio Uñate Castro
|--------------------------------------------------------------------------
|
*/

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class PHP2JSServiceProvider extends ServiceProvider
{
    /* Register services. */
    public function register(){}

    /**
     * Bootstrap services.
     * @return void
     */
    public function boot(){

        /* Pasar Variables de PHP a JS */
        Blade::directive('__PHP', function() {

            return '<script id="__PHP2JS_PRIVATE">sessionStorage.clear();get_defined_vars = <?php echo json_encode(get_defined_vars()); ?>;delete get_defined_vars.app;delete get_defined_vars.__data;delete get_defined_vars.errors;delete get_defined_vars.__env;delete get_defined_vars.__path;
            sessionStorage.setItem("get_defined_vars", JSON.stringify(get_defined_vars));delete get_defined_vars;sessionStorage.setItem("baseUrl", <?php echo json_encode(url("/")); ?>);sessionStorage.setItem("fullUrl", <?php echo json_encode(Illuminate\Support\Facades\Request::fullUrl()); ?>);sessionStorage.setItem("parameters", JSON.stringify(<?php echo json_encode(Illuminate\Support\Facades\Route::current()); ?>.parameters));sessionStorage.setItem("uri", <?php echo json_encode(Illuminate\Support\Facades\Route::current()); ?>.uri);sessionStorage.setItem("token", <?php echo json_encode(csrf_token()); ?>);sessionStorage.setItem("tokenMeta", "<meta name=" + String.fromCharCode(34) + " csrf-token" + String.fromCharCode(34) + " content=" + String.fromCharCode(34) + sessionStorage.getItem("token") + String.fromCharCode(34) + ">");sessionStorage.setItem("tokenInput", "<input type" + String.fromCharCode(34) + "hidden" + String.fromCharCode(34) + " name=" + String.fromCharCode(34) + "_token" + String.fromCharCode(34) + " value=" + String.fromCharCode(34) + sessionStorage.getItem("token") + String.fromCharCode(34) + "/>");user = <?php echo json_encode(auth()->user()); ?>;user.id = <?php echo json_encode(Illuminate\Support\Facades\Crypt::encrypt(auth()->user()->id ?? null)); ?>;delete user?.created_at;delete user?.updated_at;delete user?.email_verified_at;sessionStorage.setItem("user", JSON.stringify(user));delete user;sessionStorage.setItem("debugger", <?php echo json_encode(env("APP_DEBUG")); ?>);</script><script id="__PHP2JS_FUNCTION_S">__PHP2JS = {set:function(key,value){sessionStorage.setItem(key,value)},get:function(key){let value = sessionStorage.getItem(key);let keys=["get_defined_vars"];if(keys.includes(key)){return JSON.parse(value);}return value;}}</script><script id="__PHP2JS_REMOVE">setTimeout(()=>{document.getElementById("__PHP2JS_PRIVATE").remove();document.getElementById("__PHP2JS_REMOVE").remove();document.getElementById("__PHP2JS_FUNCTION_S").remove();},500);</script><script>class PHP{#get_defined_vars;#baseUrl;#fullUrl;#parameters;#uri;#token;#tokenMeta;#tokenInput;#user;#debug;constructor(){this.#get_defined_vars = PHP.item("get_defined_vars");this.#baseUrl = PHP.item("baseUrl");this.#fullUrl = PHP.item("fullUrl");this.#parameters = PHP.item("parameters");this.#uri = PHP.item("uri");this.#token = PHP.item("token");this.#tokenMeta = PHP.item("tokenMeta");this.#tokenInput = PHP.item("tokenInput");this.#user = PHP.item("user");this.#debug = (PHP.item("debugger") === "true") ? true : false;if(!this.#debug) setTimeout(()=>{console.clear()},50);} static item(key){let value = sessionStorage.getItem(key);let keys = ["get_defined_vars","parameters","user"];if(keys.includes(key)){return JSON.parse(value);}return value;} all(){ return {vars: this.#get_defined_vars,baseUrl: this.#baseUrl,fullUrl: this.#fullUrl,parameters: this.#parameters,uri: this.#uri,token: this.#token,tokenMeta : this.#tokenMeta,tokenInput: this.#tokenInput,user: this.#user,debug: this.#debug};} vars(){ return this.#get_defined_vars;} baseUrl(){ return this.#baseUrl;} fullUrl(){ return this.#fullUrl;} parameters(){ return this.#parameters;} uri(){ return this.#uri;} token(){ return this.#token;} tokenMeta(){ return this.#tokenMeta;} tokenInput(){ return this.#tokenInput;} user(){ return this.#user;} debug(){ return this.#debug;}} function __PHP(){return new PHP();};</script>';
        });
    }
}
