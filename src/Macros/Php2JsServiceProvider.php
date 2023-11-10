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
        /* Add Script QuickRequest */
        View::macro('withQuickRequest', function () {

            return Render::view($this->view)
                            ->with($this->getData())
                            ->withQuickRequest()
                            ->compose();
        });

        /* Return all variables to the JS context. */
        View::macro('toJS', function ($alias = 'PHP2JS') {

            return Render::view($this->view)
                            ->with($this->getData())
                            ->withQuickRequest()
                            ->toJS($alias)
                            ->compose();
        });

        /* Return only specific variables to the JavaScript context */
        View::macro('toStrictJS', function ($values = [], $alias = 'PHP2JS') {

            return Render::view($this->view)
                            ->with($this->getData())
                            ->withQuickRequest()
                            ->toStrictJS($values, $alias)
                            ->compose();
        });
    }
}
