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
        /* Add prebuilt blocks */
        View::macro('attach', function (...$attach) {
            $this->attach = $attach;

            return $this;
        });

        /* Return all variables to the JS context. */
        View::macro('toJS', function ($alias = 'PHP2JS') {
            if (isset($this->attach) && !empty($this->attach)) {
                return Render::view($this->view)
                             ->with($this->getData())
                             ->toJS($alias)
                             ->attach(...$this->attach)
                             ->compose();
            } else {
                return Render::view($this->view)
                             ->with($this->getData())
                             ->toJS($alias)
                             ->compose();
            }
        });

        /* Return only specific variables to the JavaScript context */
        View::macro('toStrictJS', function ($values = [], $alias = 'PHP2JS') {
            if (isset($this->attach) && !empty($this->attach)) {
                return Render::view($this->view)
                             ->with($this->getData())
                             ->toStrictJS($values, $alias)
                             ->attach(...$this->attach)
                             ->compose();
            } else {
                return Render::view($this->view)
                             ->with($this->getData())
                             ->toStrictJS($values, $alias)
                             ->compose();
            }
        });
    }
}
