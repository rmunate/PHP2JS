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
        return Application::VERSION ?? 'Unknown';
    }

    /**
     * Return Name Software.
     *
     * @return string
     */
    public function getEnvName(): string
    {
        return env('APP_NAME', 'Unknown');
    }

    /**
     * Return Status Debugger Server.
     *
     * @return string
     */
    public function getEnvDebug(): string
    {
        return env('APP_DEBUG', 'Unknown');
    }

    /**
     * Return Environment.
     *
     * @return string
     */
    public function getEnvironment(): string
    {
        return env('APP_ENV', 'Unknown');
    }

    /**
     * Return Environment URL.
     *
     * @return string
     */
    public function getEnvUrl(): string
    {
        return env('APP_URL','Unknown');
    }
}
