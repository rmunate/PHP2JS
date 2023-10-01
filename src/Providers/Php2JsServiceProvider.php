<?php

namespace Rmunate\Php2Js\Providers;

use Illuminate\Support\ServiceProvider;
use Rmunate\Php2Js\Commands\PHP2JSClear;

class Php2JsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerCommands();
    }

    /**
     * Register the commands provided by the service provider.
     *
     * @return void
     */
    protected function registerCommands()
    {
        $this->commands([
            PHP2JSClear::class,
        ]);
    }
}
