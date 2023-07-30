<?php

namespace Rmunate\Php2Js\Data;

use Illuminate\Foundation\Application;

class LaravelPhp2Js
{
    /**
     * Return current Version Laravel.
     *
     * @return string
     */
    public function getLaravelVersion(): string
    {
        return Application::VERSION ?? null;
    }

    /**
     * Return Name Software.
     *
     * @return string
     */
    public function getEnvName(): string
    {
        return env('APP_NAME', null);
    }

    /**
     * Return Status Debugger Server.
     *
     * @return string
     */
    public function getEnvDebug(): string
    {
        return env('APP_DEBUG', null);
    }

    /**
     * Return Environment.
     *
     * @return string
     */
    public function getEnvironment(): string
    {
        return env('APP_ENV', null);
    }

    /**
     * Return Environment URL.
     *
     * @return string
     */
    public function getEnvUrl(): string
    {
        return env('APP_URL', null);
    }
}
