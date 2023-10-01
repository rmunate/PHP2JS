<?php

namespace Rmunate\Php2Js\Data;

class ServerPhp2Js
{
    /**
     * Return ID Current Version PHP.
     *
     * @return mixed
     */
    public function getPhpVersionId()
    {
        return PHP_VERSION_ID ?? null;
    }

    /**
     * Current Version PHP.
     *
     * @return mixed
     */
    public function getPhpVersion()
    {
        return PHP_VERSION ?? null;
    }

    /**
     * Return Release Current Version PHP.
     *
     * @return mixed
     */
    public function getPhpReleaseVersion()
    {
        return PHP_RELEASE_VERSION ?? null;
    }

    /**
     * Get Server Software Name and Version.
     *
     * @return mixed
     */
    public function getServerSoftware()
    {
        return $_SERVER['SERVER_SOFTWARE'] ?? null;
    }

    /**
     * Get Operating System on which the Server is Running.
     *
     * @return mixed
     */
    public function getServerOperatingSystem()
    {
        return php_uname('s') ?? null;
    }

    /**
     * Get Enabled PHP Extensions.
     *
     * @return array
     */
    public function getPhpExtensions()
    {
        return get_loaded_extensions() ?? [];
    }

    /**
     * Get Client's Browser Language.
     *
     * @return mixed
     */
    public function getClientLanguage()
    {
        return $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? null;
    }
}
