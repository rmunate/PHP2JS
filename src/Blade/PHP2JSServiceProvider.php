<?php

namespace Rmunate\Php2Js\Blade;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Rmunate\Php2Js\Exceptions\PHP2JSExceptions;
use Rmunate\Php2Js\JS\JS;
use Rmunate\Php2Js\Support\Deprecated;

class PHP2JSServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //...
    }

    /**
     * Create Blade Directives.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Register a Blade directive for PHP2JS_AGENT.
         *
         * This directive will generate JavaScript code to get data from the PHP agent.
         * The generated JavaScript code will use the JS::script method to include the 'getDataAgent' script,
         * and will use the provided expression as the alias for the generated JavaScript code.
         *
         * Example usage in Blade template: @PHP2JS_AGENT('agentData')
         *
         * @param string $expression The expression provided in the Blade directive.
         *
         * @return string The generated JavaScript code.
         */
        Blade::directive('PHP2JS_AGENT', function ($expression) {
            return JS::script('getDataAgent')->alias($expression)->generate();
        });

        /**
         * Register a Blade directive for PHP2JS_URL.
         *
         * This directive will generate JavaScript code to get data from the current URL in use.
         * The generated JavaScript code will use the JS::script method to include the 'getDataUrl' script,
         * and will use the provided expression as the alias for the generated JavaScript code.
         *
         * Example usage in Blade template: @PHP2JS_URL('urlData')
         *
         * @param string $expression The expression provided in the Blade directive.
         *
         * @return string The generated JavaScript code.
         */
        Blade::directive('PHP2JS_URL', function ($expression) {
            return JS::script('getDataUrl')->alias($expression)->generate();
        });

        /**
         * Register a Blade directive for PHP2JS_CSRF.
         *
         * This directive will generate JavaScript code to get the CSRF token for Laravel.
         * The generated JavaScript code will use the JS::script method to include the 'getDataCSRF' script,
         * and will use the provided expression as the alias for the generated JavaScript code.
         *
         * Example usage in Blade template: @PHP2JS_CSRF('csrfData')
         *
         * @param string $expression The expression provided in the Blade directive.
         *
         * @return string The generated JavaScript code.
         */
        Blade::directive('PHP2JS_CSRF', function ($expression) {
            return JS::script('getDataCSRF')->alias($expression)->generate();
        });

        /**
         * Register a Blade directive for PHP2JS_FRAMEWORK.
         *
         * This directive will generate JavaScript code to get information from the Laravel Framework.
         * The generated JavaScript code will use the JS::script method to include the 'getDataLaravel' script,
         * and will use the provided expression as the alias for the generated JavaScript code.
         *
         * Example usage in Blade template: @PHP2JS_FRAMEWORK('laravelData')
         *
         * @param string $expression The expression provided in the Blade directive.
         *
         * @return string The generated JavaScript code.
         */
        Blade::directive('PHP2JS_FRAMEWORK', function ($expression) {
            return JS::script('getDataLaravel')->alias($expression)->generate();
        });

        /**
         * Register a Blade directive for PHP2JS_PHP.
         *
         * This directive will generate JavaScript code to get information from PHP.
         * The generated JavaScript code will use the JS::script method to include the 'getDataPHP' script,
         * and will use the provided expression as the alias for the generated JavaScript code.
         *
         * Example usage in Blade template: @PHP2JS_PHP('phpData')
         *
         * @param string $expression The expression provided in the Blade directive.
         *
         * @return string The generated JavaScript code.
         */
        Blade::directive('PHP2JS_PHP', function ($expression) {
            return JS::script('getDataPHP')->alias($expression)->generate();
        });

        /**
         * Register a Blade directive for PHP2JS_USER.
         *
         * This directive will generate JavaScript code to get user information from PHP.
         * The generated JavaScript code will use the JS::script method to include the 'getDataUser' script,
         * and will use the provided expression as the alias for the generated JavaScript code.
         *
         * Example usage in Blade template: @PHP2JS_USER('userData')
         *
         * @param string $expression The expression provided in the Blade directive.
         *
         * @return string The generated JavaScript code.
         */
        Blade::directive('PHP2JS_USER', function ($expression) {
            return JS::script('getDataUser')->alias($expression)->generate();
        });

        /**
         * Register a Blade directive for PHP2JS_VARS.
         *
         * This directive will generate JavaScript code to pass variables from PHP to JavaScript.
         * The generated JavaScript code will use the JS::script method to include the 'vars' script,
         * and will use the provided expression as the alias for the generated JavaScript code.
         *
         * Example usage in Blade template: @PHP2JS_VARS('variable1', 'variable2', ...)
         *
         * @param string $expression The expression provided in the Blade directive, representing the variables to pass.
         *
         * @return string The generated JavaScript code.
         */
        Blade::directive('PHP2JS_VARS', function ($expression) {
            return JS::script('vars')->alias($expression)->generate();
        });

        /**
         * Blade directive 'PHP2JS_VARS_STRICT'.
         * This directive is used to pass strict variables from PHP to JavaScript.
         *
         * @param string $expression The expression passed to the directive.
         *
         * @throws PHP2JSExceptions If the directive expression is not valid or empty.
         *
         * @return string The generated JavaScript script.
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

            throw PHP2JSExceptions::varsStrict();
        });

        /**
         * Blade directive '__PHP'.
         * Deprecated method without usage.
         *
         * @return BladeDirective The generated Blade directive.
         */
        Blade::directive('__PHP', function () {
            return Deprecated::__PHP();
        });

        /**
         * Blade directive 'toJS'.
         * Deprecated method without usage.
         *
         * @throws Exception An Exception indicating that the 'toJS' directive is deprecated.
         *
         * @return void
         */
        Blade::directive('toJS', function ($expression) {
            throw PHP2JSExceptions::toJSException();
        });

        /**
         * Blade directive 'toAllJS'.
         * Deprecated method without usage.
         *
         * @throws Exception An Exception indicating that the 'toAllJS' directive is deprecated.
         *
         * @return void
         */
        Blade::directive('toAllJS', function ($expression) {
            throw PHP2JSExceptions::toAllJSException();
        });

        /**
         * Blade directive 'toStrictJS'.
         * Deprecated method without usage.
         *
         * @throws Exception - An Exception indicating that the 'toStrictJS' directive is deprecated.
         *
         * @return void
         */
        Blade::directive('toStrictJS', function ($expression) {
            throw PHP2JSExceptions::toStrictJSException();
        });
    }
}
