<?php

namespace Rmunate\Php2Js\Traits;

use Rmunate\Php2Js\License\License;

/**
 * Trait JSUtilities.
 * This trait provides utility methods used by the PHP2JS library for JavaScript generation.
 */
trait JSUtilities
{
    /**
     * @param string $view
     *
     * @return string
     */
    public function clearView($view)
    {
        $view = str_replace(' ', '', $view);
        $view = str_replace(['/', '\\'], '.', $view);

        return $view;
    }

    /**
     * Generate a random unique ID.
     *
     * @return string The generated unique ID.
     */
    public function uniqueID()
    {
        return strtoupper(bin2hex(random_bytes(16)));
    }

    /**
     * Get the license comment.
     *
     * @return string The license comment.
     */
    public function licence()
    {
        return License::comment();
    }

    /**
     * Clear the alias from leading and trailing whitespace characters and dollar signs.
     *
     * @param string $alias The alias to be cleaned.
     *
     * @return string The cleaned alias.
     */
    public function clearAlias($alias)
    {
        $alias = trim($alias, " \t\n\r\0\x0B$");

        return str_replace(["'", '"'], '', $alias);
    }

    /**
     * Check if a given alias is a valid constant name.
     *
     * @param string $alias The alias to be checked.
     *
     * @return bool True if the alias is a valid constant name, false otherwise.
     */
    public function isValidConstantName($alias)
    {
        $pattern = '/^[_a-zA-Z\x7f-\xff][_a-zA-Z0-9\x7f-\xff]*$/';

        return preg_match($pattern, $alias) === 1;
    }

    /**
     * Generate a JSON string using `json_encode` with compact() function.
     *
     * @param string $reward The variable name to be compacted.
     *
     * @return string The generated JSON string.
     */
    public function jsonCompact($reward)
    {
        return '<?php echo json_encode(compact('.$reward.'), JSON_UNESCAPED_UNICODE); ?>;';
    }

    /**
     * Generate a JSON string using `json_encode` with array_diff_key() function to exclude specific variables.
     *
     * @return string The generated JSON string.
     */
    public function jsonVars()
    {
        return  '<?php echo json_encode(array_diff_key(
                    get_defined_vars(),
                    array_flip([
                        "__data",
                        "__env",
                        "__path",
                        "__currentLoopData",
                        "__file",
                        "__dir",
                        "__fluent"
                    ])
                ), JSON_UNESCAPED_UNICODE); ?>;';
    }

    /**
     * Generate a JSON string using `json_encode` with a specific method from DataPhp2Js class.
     *
     * @param string $reward The method name to be used for generating JSON.
     *
     * @return string The generated JSON string.
     */
    public function jsonSpecificMethod($reward)
    {
        return '<?php echo json_encode(\Rmunate\Php2Js\Data\DataPhp2Js::'.$reward.'(), JSON_UNESCAPED_UNICODE); ?>;';
    }

    /**
     * Inject JS code into the given HTML content.
     *
     * @param string $html   The original HTML content.
     * @param string $script The JS code to be injected.
     *
     * @return string The HTML content with the injected JS code.
     */
    public function injectJS($html, $script)
    {
        $posicionCierreHead = strpos($html, '</head>');
        $posicionCierreBody = strpos($html, '</body>');

        if ($posicionCierreHead !== false) {
            $htmlOut = substr($html, 0, $posicionCierreHead).$script.PHP_EOL.substr($html, $posicionCierreHead);
        } elseif ($posicionCierreBody !== false) {
            $htmlOut = substr($html, 0, $posicionCierreBody).$script.PHP_EOL.substr($html, $posicionCierreBody);
        } else {
            $htmlOut = $script.$html;
        }

        return $htmlOut;
    }
}
