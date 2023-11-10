<?php

namespace Rmunate\Php2Js\Traits;

trait Alias
{
    /**
     * Clear the alias from leading and trailing whitespace characters and dollar signs.
     *
     * @param string $alias The alias to be cleaned.
     *
     * @return string The cleaned alias.
     */
    public static function clear(string $alias)
    {
        return trim($alias, " \t\n\r\0\x0B$");
    }

    /**
     * Check if a given alias is a valid constant name.
     *
     * @param string $alias The alias to be checked.
     *
     * @return bool True if the alias is a valid constant name, false otherwise.
     */
    public static function isValid(string $alias)
    {
        $pattern = '/^[_a-zA-Z\x7f-\xff][_a-zA-Z0-9\x7f-\xff]*$/';

        return preg_match($pattern, $alias) === 1;
    }
}
