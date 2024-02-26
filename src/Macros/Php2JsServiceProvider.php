<?php

namespace Rmunate\Php2Js\Macros;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Rmunate\Php2Js\Render;

class Php2JsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* Return all variables to the JS context. */
        View::macro('toJS', function (string $alias = 'PHP2JS') {
            return Render::view($this->view)
                         ->with($this->getData())
                         ->toJS($alias)
                         ->compose();
        });

        /* Return only specific variables to the JavaScript context */
        View::macro('toStrictJS', function (array $values = [], string $alias = 'PHP2JS') {
            return Render::view($this->view)
                         ->with($this->getData())
                         ->toStrictJS($values, $alias)
                         ->compose();
        });
    }
}
