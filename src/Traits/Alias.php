<?php

namespace Rmunate\Php2Js\Traits;

trait Alias
{
    /**
     * Check if a given alias is a valid constant name.
     *
     * @param string $alias The alias to be checked.
     *
     * @return bool True if the alias is a valid constant name, false otherwise.
     */
    public static function isValid(string $alias)
    {
        $alias = trim($alias, " \t\n\r\0\x0B$");

        $pattern = '/^[_a-zA-Z\x7f-\xff][_a-zA-Z0-9\x7f-\xff]*$/';

        return preg_match($pattern, $alias) === 1;
    }
}
