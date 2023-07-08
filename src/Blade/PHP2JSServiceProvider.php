<?php

namespace Rmunate\Php2Js\Blade;

use Exception;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Rmunate\Php2Js\Exceptions\Messages;
use Rmunate\Php2Js\JS\JS;
use Rmunate\Php2Js\Support\Deprecated;

class PHP2JSServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //....
    }

    /**
     * Create Blade Directives.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * 🚀 PHP2JS_AGENT
         * Info From The Agent PHP.
         *
         * @return BladeDirective
         */
        Blade::directive('PHP2JS_AGENT', function ($expression) {
            return JS::script('getDataAgent')->alias($expression)->generate();
        });

        /**
         * 🚀 PHP2JS_URL
         * Info From The URL in use.
         *
         * @return BladeDirective
         */
        Blade::directive('PHP2JS_URL', function ($expression) {
            return JS::script('getDataUrl')->alias($expression)->generate();
        });

        /**
         * 🚀 PHP2JS_CSRF
         * Token For Laravel.
         *
         * @return BladeDirective
         */
        Blade::directive('PHP2JS_CSRF', function ($expression) {
            return JS::script('getDataCSRF')->alias($expression)->generate();
        });

        /**
         * 🚀 PHP2JS_FRAMEWORK
         * Info From Laravel Framework.
         *
         * @return BladeDirective
         */
        Blade::directive('PHP2JS_FRAMEWORK', function ($expression) {
            return JS::script('getDataLaravel')->alias($expression)->generate();
        });

        /**
         * 🚀 PHP2JS_PHP
         * Info From Laravel Framework.
         *
         * @return BladeDirective
         */
        Blade::directive('PHP2JS_PHP', function ($expression) {
            return JS::script('getDataPHP')->alias($expression)->generate();
        });

        /**
         * 🚀 PHP2JS_USER
         * Info From Laravel Framework.
         *
         * @return BladeDirective
         */
        Blade::directive('PHP2JS_USER', function ($expression) {
            return JS::script('getDataUser')->alias($expression)->generate();
        });

        /**
         * 🚀 BRIDGE VARS
         * Pass variables from PHP to JavaScript.
         *
         * @return BladeDirective
         */
        Blade::directive('PHP2JS_VARS', function ($expression) {
            return JS::script('vars')->alias($expression)->generate();
        });

        /**
         * 🚀 STRICT VARS
         * Pass strict variables from PHP to JavaScript.
         *
         * @return BladeDirective
         */
        Blade::directive('PHP2JS_VARS_STRICT', function ($expression) {
            if (!empty($expression)) {
                $params = str_replace(' ', '', $expression);

                if (strpos($params, '[]') !== false) {
                    $alias = str_replace('[],', '', $expression);

                    return JS::script('vars')->alias($alias)->generate();
                } elseif ((strpos($params, '[') !== false) && (strpos($params, ']') !== false)) {
                    $posicionInicio = strpos($expression, '[');
                    $posicionFin = strpos($expression, ']');
                    $compact = substr($expression, $posicionInicio, $posicionFin + 1);
                    $alias = substr($expression, $posicionFin + 2);

                    return JS::compact($compact)->alias($alias)->generate();
                }
            }

            throw new Exception(Messages::varsStrictException());
        });

        /**
         * 🚀 PHP2JS_PHP
         * Methods to support previous versions.
         *
         * @return BladeDirective
         */
        Blade::directive('__PHP', function () {
            return Deprecated::__PHP();
        });

        /**
         * 🚀 toJS
         * Deprecated methods without usage.
         *
         * @return Exception
         */
        Blade::directive('toJS', function ($expression) {
            throw new Exception(Messages::toJSException());
        });

        /**
         * 🚀 toAllJS
         * Deprecated methods without usage.
         *
         * @return Exception
         */
        Blade::directive('toAllJS', function ($expression) {
            throw new Exception(Messages::toAllJSException());
        });

        /**
         * 🚀 toAllJS
         * Deprecated methods without usage.
         *
         * @return Exception
         */
        Blade::directive('toStrictJS', function ($expression) {
            throw new Exception(Messages::toStrictJSException());
        });
    }
}
