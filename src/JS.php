<?php

namespace Rmunate\Php2Js;

use Rmunate\Php2Js\License;
use Rmunate\Php2Js\DataPhp2Js;

class JS
{

    /**
     * Propierties Object
     * Id Unique from Script
     */
    private $uniqueID;
    private $reward;
    private $alias;
    private $license;
    private $compact = false;

    /**
     * Create a Static Instance
     * @return static
     */
    public static function script(string $reward) : static
    {
        return new static($reward, false);
    }

    /**
     * Create a Static Instance
     * @return static
     */
    public static function compact(string $compact) : static
    {
        return new static($compact, true);
    }

    /**
     * Create New Instance
     * @return void
     */
    public function __construct(string $reward, bool $compact = false)
    {
        $this->uniqueID = strtoupper(bin2hex(random_bytes(16)));
        $this->reward = $reward;
        $this->license = License::comment();
        $this->compact = $compact;
    }

    /**
     * @param string $alias
     * @return static
     */
    public function alias(string $alias = 'PHP2JS')
    {
        if (empty($alias)) {
            $this->alias = 'PHP2JS';
            return $this;
        } else {
            $long = strlen($alias);
            $alias = substr($alias, 1, $long - 2);
            if (empty($alias)) {
                $this->alias = 'PHP2JS';
                return $this;
            } else {
                $patron = '/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/';
                if (preg_match($patron, $alias)) {
                    $this->alias = preg_replace('/[^a-zA-Z0-9_$]+/', '', $alias);
                    return $this;
                } else {
                    throw new \Exception('The alias "'. $alias . '" is not valid for the name of a constant in JavaScript');
                }
            }
        }
    }

    /**
     * Return Script JS
     * @return string
     */
    public function generate() : string
    {
        if ($this->compact) {
            $jsonEncode = '<?php echo json_encode(compact('.$this->reward.'),JSON_UNESCAPED_UNICODE);?>;';
        } else if ($this->reward == 'vars') {
            $jsonEncode = '<?php echo json_encode(array_diff_key(get_defined_vars(), array_flip(["app", "__data", "errors", "__env", "__path"])),JSON_UNESCAPED_UNICODE); ?>;';
        } else {
            $jsonEncode = '<?php echo json_encode(\Rmunate\Php2Js\DataPhp2Js::'.$this->reward.'(),JSON_UNESCAPED_UNICODE); ?>;';
        }
        return  '<script id="'.$this->uniqueID.'">
                    '.$this->license.'
                    const '.$this->alias.' = '.$jsonEncode.'
                    document.getElementById("'.$this->uniqueID.'").remove();
                </script>';
    }
}

?>