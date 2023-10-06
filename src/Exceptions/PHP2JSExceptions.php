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
     * Format the exception message.
     *
     * @param string $message The message to be formatted.
     *
     * @return string The formatted exception message.
     */
    private static function formatExceptionMessage(string $message)
    {
        return sprintf(
            '%s - %s Refer to the %s manual for more information: %s',
            Immutable::LIBRARY_NAME,
            $message,
            Immutable::LIBRARY_NAME,
            Immutable::MANUAL_URL
        );
    }
}
