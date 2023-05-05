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

            return "<script> class PHP{#get_defined_vars;#baseUrl;#fullUrl;#parameters;#uri;#token;#tokenMeta;#tokenInput;#user;constructor(){this.#get_defined_vars=<?php echo json_encode(get_defined_vars());?>;delete this.#get_defined_vars.app; delete this.#get_defined_vars.__data; delete this.#get_defined_vars.errors; delete this.#get_defined_vars.__env; delete this.#get_defined_vars.__path; this.#baseUrl = <?php echo json_encode(url('/')); ?>; this.#fullUrl = <?php echo json_encode(Illuminate\Support\Facades\Request::fullUrl()); ?>; this.#parameters = <?php echo json_encode(Illuminate\Support\Facades\Route::current()); ?>.parameters; this.#uri = <?php echo json_encode(Illuminate\Support\Facades\Route::current()); ?>.uri; this.#token = <?php echo json_encode(csrf_token()); ?>; this.#tokenMeta = '<meta name=' + String.fromCharCode(34) + ' csrf-token' + String.fromCharCode(34) + ' content=' + String.fromCharCode(34) + this.#token + String.fromCharCode(34) + '>'; this.#tokenInput = '<input type' + String.fromCharCode(34) + 'hidden' + String.fromCharCode(34) + ' name=' + String.fromCharCode(34) + '_token' + String.fromCharCode(34) + ' value=' + String.fromCharCode(34) + this.#token + String.fromCharCode(34) + '/>'; this.#user = <?php echo json_encode(auth()->user()); ?>;delete this.#user?.created_at;delete this.#user?.updated_at;delete this.#user?.email_verified_at;} all(){return{vars:this.#get_defined_vars,baseUrl:this.#baseUrl,fullUrl:this.#fullUrl,parameters:this.#parameters,uri:this.#uri,token:this.#token,tokenMeta:this.#tokenMeta,tokenInput:this.#tokenInput,user:this.#user};} vars(){return this.#get_defined_vars;} baseUrl(){return this.#baseUrl;} fullUrl(){return this.#fullUrl;} parameters(){return this.#parameters;} uri(){return this.#uri;} token(){return this.#token;} tokenMeta(){return this.#tokenMeta;} tokenInput(){return this.#tokenInput;} user(){return this.#user;}} function __PHP(){return new PHP();};</script>";
        });
    }
}
