<?php

namespace Rmunate\Php2Js\License;

use Rmunate\Php2Js\Data\DataPhp2Js;

class License
{
    /**
     * Generate Text License.
     *
     * @return comment license
     */
    public static function comment()
    {
        $version = DataPhp2Js::VERSION;

        return <<<EOT
        /* Library: PHP2JS | Author: Raul Mauricio Uñate Castro | Version: {$version} | License: MIT | URL: https://github.com/rmunate/PHP2JS */
        EOT;
    }
}
