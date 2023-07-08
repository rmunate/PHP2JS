<?php

namespace Rmunate\Php2Js\Bases;

abstract class BasePhp2Js
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
        throw new \BadMethodCallException(sprintf(
            'Method %s::%s does not exist.',
            static::class,
            $method
        ));
    }
}
