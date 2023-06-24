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
    private $method;
    private $alias;
    private $license;

    /**
     * Create a Static Instance
     * @return static
     */
    public static function script(string $method) : static
    {
        return new static($method);
    }

    /**
     * Create New Instance
     * @return void
     */
    public function __construct(string $method)
    {
        $this->uniqueID = strtoupper(bin2hex(random_bytes(16)));
        $this->method = $method;
        $this->license = License::comment();
    }

    /**
     * @param string $alias
     * @return static
     */
    public function alias(string $alias = 'PHP2JS')
    {
        $this->alias = str_replace(['"', "'"],"",$alias);
    }

    /**
     * Return Script JS
     * @return string
     */
    public function generate() : string
    {
        return  '<script id="'.$this->uniqueID.'">
                    '.$this->license.'
                    const '.$this->alias.' = <?php echo json_encode(\Rmunate\Php2Js\DataPhp2Js::'.$this->method.'()); ?>;
                    document.getElementById("'.$this->uniqueID.'").remove();
                </script>';
    }

    /**
     * Return Vars PHP To JS
     * @return string
     */
    public function bridge() : string
    {
        return  '<script id="'.$this->uniqueID.'">
                    '.$this->license.'
                    const '.$this->alias.' = <?php echo json_encode(array_diff_key(get_defined_vars(), array_flip(["app", "__data", "errors", "__env", "__path"]))); ?>;
                    document.getElementById("'.$this->uniqueID.'").remove();
                </script>';
    }

    

}

?>