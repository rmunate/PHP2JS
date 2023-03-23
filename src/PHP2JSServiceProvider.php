<?php

namespace Rmunate\Php2Js;

/*
|--------------------------------------------------------------------------
| Envio de variables de PHP a JS en vistas Blade
|--------------------------------------------------------------------------
| Autor: Raul Mauricio Uñate Castro
| V 1.0.0 : 02-02-2022
| V 2.0.0 : 04-01-2023
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
                        vars: Utilities.base64Encode(<?php echo json_encode(get_defined_vars()); ?>, Utilities.Charset.UTF_8),
                        route: Utilities.base64Encode(<?php echo json_encode(Illuminate\Support\Facades\Route::currentRouteName()); ?>, Utilities.Charset.UTF_8),
                        fullUrl: Utilities.base64Encode(<?php echo json_encode(Illuminate\Support\Facades\Request::fullUrl()); ?>, Utilities.Charset.UTF_8),
                        url: Utilities.base64Encode(<?php echo json_encode(Illuminate\Support\Facades\Request::url()); ?>, Utilities.Charset.UTF_8),
                        root: Utilities.base64Encode(<?php echo json_encode(Illuminate\Support\Facades\Request::root()); ?>, Utilities.Charset.UTF_8),
                        token: Utilities.base64Encode(<?php echo json_encode(csrf_token()); ?>, Utilities.Charset.UTF_8),
                        baseUrl: Utilities.base64Encode(<?php echo json_encode(url('/')); ?>, Utilities.Charset.UTF_8),
                        user: Utilities.base64Encode(<?php echo json_encode(auth()->user()); ?>, Utilities.Charset.UTF_8)
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
