<?php

namespace Rmunate\Php2Js;

/*
|--------------------------------------------------------------------------
| Envio de variables de PHP a JS en vistas Blade
|--------------------------------------------------------------------------
| Developer = Raúl Mauricio Uñate Castro. (raulmauriciounate@gmail.com)
| Developer = Wirmer A. Sanchez Saez 
| Developer = Jorge Hernan Castañeda (ds.jorgecastaneda@gmail.com)
| Developer = Julio C. Borges (julio-borgeslopez@outlook.com)
|--------------------------------------------------------------------------
|
*/

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class PHP2JSServiceProvider extends ServiceProvider
{
    public function register(){}
    public function boot(){
        Blade::directive('__PHP', function() {
            return '<script id="__PHP2JS_PRIVATE">sessionStorage.clear();unique_php2js = Math.random().toString(16).slice(2);var bridgePHP={get_defined_vars:unique_php2js+"_vars",baseUrl:unique_php2js+"_baseUrl",fullUrl:unique_php2js+"_fullUrl",parameters:unique_php2js+"_parameters",uri:unique_php2js+"_uri",token:unique_php2js+"_token",tokenMeta:unique_php2js+"_tokenMeta",tokenInput:unique_php2js+"_tokenInput",user:unique_php2js+"_user",debugger:unique_php2js+"_debugger"};delete unique_php2js;sessionStorage.setItem(bridgePHP.get_defined_vars,JSON.stringify(<?php echo json_encode(array_diff_key(get_defined_vars(), array_flip(["app", "__data", "errors", "__env", "__path"]))); ?>));sessionStorage.setItem(bridgePHP.baseUrl, <?php echo json_encode(url("/")); ?>);sessionStorage.setItem(bridgePHP.fullUrl, <?php echo json_encode(Illuminate\Support\Facades\Request::fullUrl()); ?>);sessionStorage.setItem(bridgePHP.parameters, JSON.stringify(<?php echo json_encode(Illuminate\Support\Facades\Route::current()); ?>.parameters));sessionStorage.setItem(bridgePHP.uri, <?php echo json_encode(Illuminate\Support\Facades\Route::current()); ?>.uri);sessionStorage.setItem(bridgePHP.token, <?php echo json_encode(csrf_token()); ?>);sessionStorage.setItem(bridgePHP.tokenMeta, "<meta name="+String.fromCharCode(34)+" csrf-token"+String.fromCharCode(34)+" content="+String.fromCharCode(34)+sessionStorage.getItem("token")+String.fromCharCode(34)+">");sessionStorage.setItem(bridgePHP.tokenInput, "<input type"+String.fromCharCode(34)+"hidden"+String.fromCharCode(34)+" name="+String.fromCharCode(34)+"_token"+String.fromCharCode(34)+" value="+String.fromCharCode(34)+sessionStorage.getItem("token")+String.fromCharCode(34)+"/>");user = <?php echo json_encode(auth()->user()); ?>;user.id = <?php echo json_encode(Illuminate\Support\Facades\Crypt::encrypt(!empty(auth()->user()->id) ? auth()->user()->id : null)); ?>;delete user?.created_at;delete user?.updated_at;delete user?.email_verified_at;sessionStorage.setItem(bridgePHP.user, JSON.stringify(user));delete user;sessionStorage.setItem(bridgePHP.debugger, <?php echo json_encode(env("APP_DEBUG")); ?>);</script><script id="__PHP2JS_FUNCTION_S">function __PHP2JS(e){let r=sessionStorage.getItem(e);return[bridgePHP.get_defined_vars,bridgePHP.parameters,bridgePHP.user].includes(e)?JSON.parse(r):r};function __PHP2JS_SAFE(){setTimeout(()=>{console.clear()},50)}</script><script id="__PHP2JS_REMOVE">setTimeout(()=>{document.getElementById("__PHP2JS_PRIVATE").remove(),document.getElementById("__PHP2JS_REMOVE").remove(),document.getElementById("__PHP2JS_FUNCTION_S").remove()},500);</script><script>class PHP{#a;#b;#c;#d;#e;#f;#g;#h;#i;#j;constructor(){this.#a=PHP.item(bridgePHP.get_defined_vars),this.#b=PHP.item(bridgePHP.baseUrl),this.#c=PHP.item(bridgePHP.fullUrl),this.#d=PHP.item(bridgePHP.parameters),this.#e=PHP.item(bridgePHP.uri),this.#f=PHP.item(bridgePHP.token),this.#g=PHP.item(bridgePHP.tokenMeta),this.#h=PHP.item(bridgePHP.tokenInput),this.#i=PHP.item(bridgePHP.user),this.#j="true"===PHP.item(bridgePHP.debugger),this.#j||__PHP2JS_SAFE()}static item(t){return __PHP2JS(t)}all(){return{vars:this.#a,baseUrl:this.#b,fullUrl:this.#c,parameters:this.#d,uri:this.#e,token:this.#f,tokenMeta:this.#g,tokenInput:this.#h,user:this.#i,debug:this.#j}}vars(){return this.#a}baseUrl(){return this.#b}fullUrl(){return this.#c}parameters(){return this.#d}uri(){return this.#e}token(){return this.#f}tokenMeta(){return this.#g}tokenInput(){return this.#h}user(){return this.#i}debug(){return this.#j}};function __PHP(){return new PHP} const $PHP_VARS=PHP.item(bridgePHP.get_defined_vars),$PHP_BASE_URL=PHP.item(bridgePHP.baseUrl),$PHP_FULL_URL=PHP.item(bridgePHP.fullUrl),$PHP_PARAMETERS=PHP.item(bridgePHP.parameters),$PHP_URI=PHP.item(bridgePHP.uri),$PHP_TOKEN=PHP.item(bridgePHP.token),$PHP_TOKEN_META=PHP.item(bridgePHP.tokenMeta),$PHP_TOKEN_INPUT=PHP.item(bridgePHP.tokenInput),$PHP_USER=PHP.item(bridgePHP.tokenInput),$PHP_DEBUG=PHP.item(bridgePHP.debug);const $PHP={vars:$PHP_VARS,baseUrl:$PHP_BASE_URL,fullUrl:$PHP_FULL_URL,parameters:$PHP_PARAMETERS,uri:$PHP_URI,token:$PHP_TOKEN,tokenMeta:$PHP_TOKEN_META,tokenInput:$PHP_TOKEN_INPUT,user:$PHP_USER,debug:$PHP_DEBUG};</script>';
        });
    }
}
