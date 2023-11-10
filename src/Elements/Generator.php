<?php

namespace Rmunate\Php2Js\Elements;

use Exception;
use Rmunate\Php2Js\Traits\Alias;
use Rmunate\Php2Js\Traits\Json;

/**
 * Class RenderingJS
 * A class providing methods for rendering JavaScript-related elements.
 */
class Generator
{
    use Json;
    use Alias;

    /**
     * Generate HTML span element with encoded JSON data and a specified alias.
     *
     * @param array  $data  The data to be encoded and stored in the span element.
     * @param string $alias The alias to be used for the span element class and data attribute.
     *
     * @throws Exception If the provided alias is not valid.
     *
     * @return string The HTML span element with encoded data.
     */
    public static function data(array $data, string $alias)
    {
        // Clear the alias for safety
        $alias = Alias::clear($alias);

        // Check if the alias is valid
        if (!Alias::isValid($alias)) {
            throw new Exception("PHP2JSException: The provided alias '$alias' is not valid.");
        }

        // Encode data to JSON without escaping Unicode characters
        $jsonData = Json::encodeUnescapedUnicode($data);

        // Create and return the HTML span element
        return '<meta name="__'.$alias.'Data" content=\''.$jsonData.'\'>';
    }

    /**
     * Generate PHP2JS JavaScript stub content with a specified alias.
     *
     * @param string $alias The alias to be used in the PHP2JS stub content.
     *
     * @return string The PHP2JS JavaScript stub content.
     */
    public static function PHP2JS(string $alias)
    {
        // Get the content of the PHP2JS stub file
        $stubContent = file_get_contents(__DIR__.'/../Stubs/PHP2JS.stub');

        // Replace the placeholder with the provided alias
        return str_replace('{PHP2JS}', $alias, $stubContent);
    }

    /**
     * Generate HTML meta tag for QuickRequest token.
     *
     * @return string The HTML meta tag for QuickRequest token.
     */
    public static function quickRequestToken()
    {
        return '<meta name="__QuickRequestToken" content="'.csrf_token().'">';
    }

    /**
     * Generate QuickRequest JavaScript stub content.
     *
     * @return string The QuickRequest JavaScript stub content.
     */
    public static function quickRequest()
    {
        // Get the content of the QuickRequest stub file
        return file_get_contents(__DIR__.'/../Stubs/QuickRequest.stub');
    }
}
