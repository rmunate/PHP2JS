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
        return PHP_VERSION_ID ?? null;
    }

    /**
     * Current Version PHP.
     *
     * @return string
     */
    public function getPhpVersion(): string
    {
        return PHP_VERSION ?? null;
    }

    /**
     * Return Release Current Version PHP.
     *
     * @return string
     */
    public function getPhpReleaseVersion(): string
    {
        return PHP_RELEASE_VERSION ?? null;
    }

    /**
     * Get Server Software Name and Version.
     *
     * @return string
     */
    public function getServerSoftware(): string
    {
        return $_SERVER['SERVER_SOFTWARE'] ?? null;
    }

    /**
     * Get Operating System on which the Server is Running.
     *
     * @return string
     */
    public function getServerOperatingSystem(): string
    {
        return php_uname('s') ?? null;
    }

    /**
     * Get Enabled PHP Extensions.
     *
     * @return array
     */
    public function getPhpExtensions(): array
    {
        return get_loaded_extensions() ?? [];
    }

    /**
     * Get Client's Browser Language.
     *
     * @return string
     */
    public function getClientLanguage(): string
    {
        return $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? null;
    }
}
