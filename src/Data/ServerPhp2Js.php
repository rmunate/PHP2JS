<?php

namespace Rmunate\Php2Js\Data;

class ServerPhp2Js
{
    /**
     * Return ID Current Version PHP.
     *
     * @return string
     */
    public function getPhpVersionId(): string
    {
        return PHP_VERSION_ID;
    }

    /**
     * Current Version PHP.
     *
     * @return string
     */
    public function getPhpVersion(): string
    {
        return PHP_VERSION;
    }

    /**
     * Return Release Current Version PHP.
     *
     * @return string
     */
    public function getPhpReleaseVersion(): string
    {
        return PHP_RELEASE_VERSION;
    }
}
