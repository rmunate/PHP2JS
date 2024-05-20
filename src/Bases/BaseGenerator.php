<?php

namespace Rmunate\Php2Js\Bases;

use BadMethodCallException;

abstract class BaseGenerator
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
     * Create a new instance with an alias.
     *
     * @param string $alias
     *
     * @return static
     */
    public static function alias(string $alias = 'PHP2JS'): static
    {
        return new static($alias);
    }
}
