<?php

namespace Rmunate\Php2Js\Bases;

use BadMethodCallException;

abstract class BaseRender
{
    /**
     * Handle calls to missing methods.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @throws BadMethodCallException
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        throw new BadMethodCallException(sprintf(
            'Method %s::%s does not exist.',
            static::class,
            $method
        ));
    }

    /**
     * Create a new instance with a view.
     *
     * @param string $view
     *
     * @return static
     */
    public static function view(string $view)
    {
        return new static($view);
    }
}
