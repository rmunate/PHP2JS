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
    public static function comment()
    {
        $name = Immutable::LIBRARY_NAME;
        $author = Immutable::AUTHOR;
        $version = Immutable::VERSION;
        $license = Immutable::LICENSE;
        $url = Immutable::MANUAL_URL;

        return <<<EOT
        /* ---- Library: {$name} | Author: {$author} | Version: {$version} | License: {$license} | URL: {$url} ---- */
        EOT;
    }
}
