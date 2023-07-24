<?php

namespace Rmunate\Php2Js\Exceptions;

use BadMethodCallException;

class MethodNotFoundException extends BadMethodCallException
{
    /**
     * Create a new MethodNotFoundException instance.
     *
     * @param string $className
     * @param string $methodName
     *
     * @return static 
     */
    public static function create(string $className, string $methodName)
    {
        return new static(sprintf(
            'Method %s::%s does not exist.',
            $className,
            $methodName
        ));
    }
}
