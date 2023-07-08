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
        return Application::VERSION;
    }

    /**
     * Return Name Software.
     *
     * @return string
     */
    public function getEnvName(): string
    {
        return env('APP_NAME');
    }

    /**
     * Return Status Debugger Server.
     *
     * @return string
     */
    public function getEnvDebug(): string
    {
        return env('APP_DEBUG');
    }
}
