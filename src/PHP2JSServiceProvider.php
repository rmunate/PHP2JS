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

            return "<script>

            class PHP {
            
                constructor() { 
                    this.data = {
                        vars: <?php echo json_encode(get_defined_vars()); ?>,
                        route: <?php echo json_encode(Illuminate\Support\Facades\Route::currentRouteName()); ?>,
                        fullUrl: <?php echo json_encode(Illuminate\Support\Facades\Request::fullUrl()); ?>,
                        url: <?php echo json_encode(Illuminate\Support\Facades\Request::url()); ?>,
                        root: <?php echo json_encode(Illuminate\Support\Facades\Request::root()); ?>,
                        token: <?php echo json_encode(csrf_token()); ?>,
                        baseUrl: <?php echo json_encode(url('/')); ?>,
                        user: <?php echo json_encode(auth()->user()); ?>
                    }
                }
                
                all(){
                    delete this.data.start;
                    delete this.data.end;
                    return this.data;
                }
                
                vars(){
                    delete this.data.vars.app;
                    delete this.data.vars.__data;
                    delete this.data.vars.errors;
                    delete this.data.vars.__env;
                    delete this.data.vars.__path;
                    return this.data.vars;
                }
            
                baseUrl(){
                    return this.data.baseUrl;
                }
            
                user(){
                    return this.data.baseUrl;
                }
                
                errors(){
                    return this.data.vars.errors;
                }
                
                path(){
                    return this.data.vars.__path;
                } 
                
                env(){
                    return this.data.vars.__env;
                }
                
                app(){
                    return this.data.vars.app;
                }
                
                route(){
                    return this.data.route;
                }
                
                fullUrl(){
                    return this.data.fullUrl;
                }
                
                url(){
                    return this.data.url;
                } 
                
                root(){
                    return this.data.root;
                }
                
                token(){
                    return this.data.token;
                } 
                
                tokenMeta(){
                    return '<meta name=' + String.fromCharCode(34) + ' csrf-token' + String.fromCharCode(34) + ' content=' + String.fromCharCode(34) + this.data.token + String.fromCharCode(34) + '>';
                }
                
                tokenInput(){
                    return '<input type' + String.fromCharCode(34) + 'hidden' + String.fromCharCode(34) + ' name=' + String.fromCharCode(34) + '_token' + String.fromCharCode(34) + ' value=' + String.fromCharCode(34) + this.data.token + String.fromCharCode(34) + '/>';
                }
            }
                
            function __PHP() {
                return new PHP();
            };
            
            </script>";
        });
    }
}
