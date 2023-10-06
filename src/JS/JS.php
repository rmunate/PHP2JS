<?php

namespace Rmunate\Php2Js\JS;

use Rmunate\Php2Js\Exceptions\PHP2JSExceptions;
use Rmunate\Php2Js\Traits\JSUtilities;

class JS
{
    use JSUtilities;

    /**
     * The alias used to access the JavaScript object in the generated script tag.
     *
     * @var string
     */
    private $alias;

    /**
     * The reward data that will be assigned to the JavaScript object.
     *
     * @var mixed
     */
    private $reward;

    /**
     * The license text to be included in the generated script tag.
     *
     * @var string
     */
    private $license;

    /**
     * A unique identifier for the script tag.
     *
     * @var string
     */
    private $uniqueID;

    /**
     * A flag to indicate whether the data should be compacted when generating the script tag.
     *
     * @var bool
     */
    private $compact = false;

    /**
     * Create a Static Instance.
     * Use to Blade Directives.
     *
     * @return static
     */
    public static function script(string $reward)
    {
        return new self($reward, false);
    }

    /**
     * Create a Static Instance.
     * Use To StrictJS Blade Directives.
     *
     * @return static
     */
    public static function compact(string $compact)
    {
        return new self($compact, true);
    }

    /**
     * Create New Instance.
     *
     * @return void
     */
    public function __construct(string $reward, bool $compact = false)
    {
        $this->uniqueID = $this->uniqueID();
        $this->license = $this->licence();
        $this->reward = $reward;
        $this->compact = $compact;
    }

    /**
     * @param string $alias
     *
     * @return static
     */
    public function alias(string $alias = 'PHP2JS')
    {
        $alias = $this->clearAlias($alias);

        if (empty($alias)) {
            $this->alias = 'PHP2JS';
        } else {
            if ($this->isValidConstantName($alias)) {
                $this->alias = $alias;
            } else {
                throw PHP2JSExceptions::notIsValidConstantName($alias);
            }
        }

        return $this;
    }

    /**
     * Return Script JS.
     *
     * @return string
     */
    public function generate()
    {
        // Encode the final object based on the configuration
        if ($this->compact) {
            $jsonEncode = $this->jsonCompact($this->reward);
        } elseif ($this->reward === 'vars') {
            $jsonEncode = $this->jsonVars();
        } else {
            $jsonEncode = $this->jsonSpecificMethod($this->reward);
        }

        // Generate the final script tag using the helper method
        return self::generateScriptTag($this->uniqueID, $this->license, $this->alias, $jsonEncode);
    }

    /**
     * @param mixed $idElement
     * @param mixed $license
     * @param mixed $alias
     *
     * @return string
     */
    public static function generateScriptTag($id, $license, $alias, $json)
    {
        // Read the content of the stub file
        $stubContent = file_get_contents(__DIR__.'/../Stubs/ScriptJS.stub');

        // Replace placeholders with actual values
        $generatedScript = str_replace(
            ['{ID}', '{LICENSE}', '{ALIAS}', '{JSON}'],
            [$id, $license, $alias, $json],
            $stubContent
        );

        return $generatedScript;
    }
}
