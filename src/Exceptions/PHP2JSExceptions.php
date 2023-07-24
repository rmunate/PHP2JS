<?php

declare(strict_types=1);

namespace Rmunate\Php2Js\Exceptions;

use Exception;
use Rmunate\Php2Js\Constants\Immutable;

class PHP2JSExceptions extends Exception
{
    /**
     * Create a new PHP2JSExceptions instance.
     *
     * @param string     $message  The exception message.
     * @param int        $code     The exception code (optional).
     * @param \Throwable $previous The previous exception (optional).
     *
     * @return static 
     */
    public static function create(string $message, int $code = 0, \Throwable $previous = null)
    {
        return new static($message, $code, $previous);
    }

    /**
     * Generate an exception message for the `Invalid Constante Name For JS`.
     *
     * @return static The exception instance.
     */
    public static function notIsValidConstantName($alias)
    {
        $message = self::formatExceptionMessage('The alias "'.$alias.'" is not valid for the name of a constant in JavaScript');

        return self::create($message);
    }

    /**
     * Generate an exception message for the `varsStrict` method.
     *
     * @return static The exception instance.
     */
    public static function varsStrict()
    {
        $message = self::formatExceptionMessage("Directive exception '@PHP2JS_VARS_STRICT()'. It is required to define the variables to share with JavaScript ['variable1', 'variable2', ...]. If you do not want to specify which variables to share, you can use the '@PHP2JS_VARS()' directive.");

        return self::create($message);
    }

    /**
     * Generate an exception message for the `toJS` method.
     *
     * @return static The exception instance.
     */
    public static function toJSException()
    {
        $message = self::formatExceptionMessage("The 'toJS' directive was removed from the library due to a process of standardization of use. You can replace it as needed according to the new standard defined in the manual.");

        return self::create($message);
    }

    /**
     * Generate an exception message for the `toAllJS` method.
     *
     * @return static The exception instance.
     */
    public static function toAllJSException()
    {
        $message = self::formatExceptionMessage("The 'toAllJS' directive was removed from the library due to a process of standardization of use. You can replace it as needed according to the new standard defined in the manual.");

        return self::create($message);
    }

    /**
     * Generate an exception message for the `toStrictJS` method.
     *
     * @return static The exception instance.
     */
    public static function toStrictJSException()
    {
        $message = self::formatExceptionMessage("The 'toStrictJS' directive was removed from the library due to a process of standardization of use. You can replace it as needed according to the new standard defined in the manual.");

        return self::create($message);
    }

    /**
     * Format the exception message.
     *
     * @param string $message The message to be formatted.
     *
     * @return string The formatted exception message.
     */
    private static function formatExceptionMessage(string $message): string
    {
        return Immutable::LIBRARY_NAME.' - '.$message.' Refer to the '.Immutable::LIBRARY_NAME.' manual for more information: '.Immutable::MANUAL_URL;
    }
}
