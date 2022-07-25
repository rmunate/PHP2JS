<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class AltumServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     * @return void
     */
    public function register(){
    }

    /**
     * Bootstrap services.
     * @return void
     */
    public function boot(){

        /* Pasar Variables de PHP a JS */
        Blade::directive('PHP2JS', function () {
            return "<script type='text/javascript'> window.open.service = <?php echo json_encode(bin2hex(random_bytes(pow(2, 16)))) ?>; class PHP { constructor(){ this.data = { vars: <?php echo json_encode(get_defined_vars()); ?>, route: <?php echo json_encode(Illuminate\Support\Facades\Route::currentRouteName()); ?>, fullUrl: <?php echo json_encode(Illuminate\Support\Facades\Request::fullUrl()); ?>, url: <?php echo json_encode(Illuminate\Support\Facades\Request::url()); ?>, root: <?php echo json_encode(Illuminate\Support\Facades\Request::root()); ?>, token: <?php echo json_encode(csrf_token()); ?> } } all(){ return this.data; } vars(){ delete this.data.vars.app; delete this.data.vars.__data; delete this.data.vars.errors; delete this.data.vars.__env; delete this.data.vars.__path; return this.data.vars; } errors(){ return this.data.vars.errors; } path(){ return this.data.vars.__path; } env(){ return this.data.vars.__env; } app(){ return this.data.vars.app; } route(){ return this.data.route; } fullUrl(){ return this.data.fullUrl; } url(){ return this.data.url; } root(){ return this.data.root; } token(){ return this.data.token; } tokenMeta(){ return '<meta name=' + String.fromCharCode(34) + 'csrf-token' + String.fromCharCode(34) + ' content=' + String.fromCharCode(34) + this.data.token + String.fromCharCode(34) + '>'; } tokenInput(){ return '<input type' + String.fromCharCode(34) + 'hidden' + String.fromCharCode(34) + ' name=' + String.fromCharCode(34) + '_token' + String.fromCharCode(34) + ' value=' + String.fromCharCode(34) + this.data.token + String.fromCharCode(34) + '/>'; } } function __php(){ let x = new PHP(); return x; }; window.close.service = <?php echo json_encode(bin2hex(random_bytes(pow(2, 16)))) ?>; </script>";
        });
    }
}
