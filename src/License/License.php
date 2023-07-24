<?php

namespace Rmunate\Php2Js\License;

use Rmunate\Php2Js\Constants\Immutable;

class License
{
    /**
     * Generate the license comment.
     * 
     * @return string
     */
    public static function comment(): string
    {
        $version = Immutable::VERSION;
        $author = Immutable::AUTHOR;
        $license = Immutable::LICENSE;
        $url = Immutable::MANUAL_URL;

        return <<<EOT
        /* Library: PHP2JS | Author: {$author} | Version: {$version} | License: {$license} | URL: {$url} */
        EOT;
    }
}
