<?php

namespace Rmunate\Php2Js\Elements;

use Exception;
use Rmunate\Php2Js\Traits\Alias;
use Rmunate\Php2Js\Bases\BaseGenerator;

class Generator extends BaseGenerator
{
    use Alias;

    /**
     * Constructor.
     *
     * @param string $alias The alias to be used for the span element class and data attribute.
     *
     * @throws Exception If the provided alias is not valid.
     */
    public function __construct(string $alias)
    {
        // Check if the alias is valid
        if (!Alias::isValid($alias)) {
            throw new Exception("PHP2JSException: The provided alias '$alias' is not valid.");
        }

        $this->alias = $alias;
    }

    /**
     * Generate HTML span element with encoded JSON data and a specified alias.
     *
     * @param array $data The data to be encoded and stored in the span element.
     *
     * @throws Exception If the provided alias is not valid.
     *
     * @return string The HTML span element with encoded data.
     */
    public function data(array $data)
    {
        // Encode data to JSON without escaping Unicode characters
        $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);

        // Replace placeholders in the meta tag template
        $metaTag = sprintf(
            '<meta name="X-%s-DATA" content="%s">',
            $this->alias,
            htmlspecialchars($jsonData, ENT_QUOTES, 'UTF-8')
        );

        // Return the HTML meta tag
        return $metaTag;
    }

    /**
     * Generate PHP2JS script JavaScript stub content with the set alias.
     *
     * @return string The PHP2JS script JavaScript stub content.
     */
    public function script()
    {
        // Get the content of the PHP2JS stub file
        $stub = file_get_contents(__DIR__.'/../Stubs/PHP2JS.stub');

        // Replace the placeholder with the set alias
        return str_replace('{PHP2JS}', $this->alias, $stub);
    }
}