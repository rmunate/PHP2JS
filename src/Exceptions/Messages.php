<?php

namespace Rmunate\Php2Js\Exceptions;

class Messages
{
    public const MANUAL_URL = 'https://github.com/rmunate/PHP2JS';
    public const LIBRARY_NAME = 'PHP2JS';

    /**
     * Generate an exception message for the `varsStrict` method.
     *
     * @return string The exception message.
     */
    public static function varsStrictException(): string
    {
        return self::LIBRARY_NAME." - Directive exception '@PHP2JS_VARS_STRICT()'. It is required to define the variables to share with JavaScript ['variable1', 'variable2', ...]. If you do not want to specify which variables to share, you can use the '@PHP2JS_VARS()' directive. Refer to the ".self::LIBRARY_NAME.' manual for more information: '.self::MANUAL_URL;
    }

    /**
     * Generate an exception message for the `toJS` method.
     *
     * @return string The exception message.
     */
    public static function toJSException(): string
    {
        return self::LIBRARY_NAME." - The 'toJS' directive was removed from the library due to a process of standardization of use. You can replace it as needed according to the new standard defined in the ".self::LIBRARY_NAME.' manual: '.self::MANUAL_URL;
    }

    /**
     * Generate an exception message for the `toAllJS` method.
     *
     * @return string The exception message.
     */
    public static function toAllJSException(): string
    {
        return self::LIBRARY_NAME." - The 'toAllJS' directive was removed from the library due to a process of standardization of use. You can replace it as needed according to the new standard defined in the ".self::LIBRARY_NAME.' manual: '.self::MANUAL_URL;
    }

    /**
     * Generate an exception message for the `toStrictJS` method.
     *
     * @return string The exception message.
     */
    public static function toStrictJSException(): string
    {
        return self::LIBRARY_NAME." - The 'toStrictJS' directive was removed from the library due to a process of standardization of use. You can replace it as needed according to the new standard defined in the ".self::LIBRARY_NAME.' manual: '.self::MANUAL_URL;
    }
}
