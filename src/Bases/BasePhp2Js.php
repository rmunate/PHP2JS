<?php

namespace Rmunate\Php2Js\Bases;

use Rmunate\Php2Js\Exceptions\MethodNotFoundException;

abstract class BasePhp2Js
{
    /**
     * Handle calls to missing methods.
     * @param string $method
     * @param array  $parameters
     *
     * @throws MethodNotFoundException
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        throw MethodNotFoundException::create(static::class, $method);
    }
}
