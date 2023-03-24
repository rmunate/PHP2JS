<?php

namespace Rmunate\Php2Js;

/*
|--------------------------------------------------------------------------
| Envio de variables de PHP a JS en vistas Blade
|--------------------------------------------------------------------------
| Autor: Raul Mauricio Uñate Castro
| V_ : 02-02-2022
| V_ : 04-01-2023
| V_ : 24-03-2023
|--------------------------------------------------------------------------
|
*/

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Crypt;
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

        /* User */
        if (!empty(auth()->user())) {
            $usr = auth()->user()->toArray();
            $usr['id'] = isset($usr['id']) ? Crypt::encrypt($usr['id']) : null;
            if (isset($usr['created_at'])) {
                unset($usr['created_at']);
            }
            if (isset($usr['updated_at'])) {
                unset($usr['updated_at']);
            }
        } else {
            $usr = null;
        }

        /* Data Directive */
        $data = (object) [
            'vars' => json_encode(get_defined_vars()),
            'baseUrl' => json_encode(url('/')),
            'token' => json_encode(csrf_token()),
            'url' => json_encode(Request::url()),
            'fullUrl' => json_encode(Request::fullUrl()),
            'route' => json_encode(Route::currentRouteName()),
            'root' => json_encode(Request::root()),
            'user' => json_encode($usr),
        ];

        /* Pasar Variables de PHP a JS */
        Blade::directive('__PHP', function() use($data) {


            return "<script>

            class PHP {
            
                constructor() { 
                    this.data = {
                        vars: <?php echo $data->vars; ?>,
                        route: <?php echo $data->route; ?>,
                        fullUrl: <?php echo $data->fullUrl; ?>,
                        url: <?php echo $data->url; ?>,
                        root: <?php echo $data->root; ?>,
                        token: <?php echo $data->token; ?>,
                        baseUrl: <?php echo $data->baseUrl; ?>,
                        user: <?php echo $data->user; ?>
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
