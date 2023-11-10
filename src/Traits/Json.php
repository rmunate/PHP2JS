<?php

namespace Rmunate\Php2Js\Traits;

trait Json
{
    /**
     * Encode an array to JSON without escaping Unicode characters.
     *
     * @param array $values The array to encode.
     *
     * @return string|null The JSON-encoded string or null on failure.
     */
    public static function encodeUnescapedUnicode(array $values)
    {
        // Using json_encode with JSON_UNESCAPED_UNICODE option
        return json_encode($values, JSON_UNESCAPED_UNICODE);
    }
}
