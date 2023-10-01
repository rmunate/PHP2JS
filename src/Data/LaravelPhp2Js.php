<?php

namespace Rmunate\Php2Js\Data;

use Illuminate\Foundation\Application;

class LaravelPhp2Js
{
    /**
     * Return current Version Laravel.
     *
     * @return mixed
     */
    public function getLaravelVersion()
    {
        return Application::VERSION ?? null;
    }

    /**
     * Return Name Software.
     *
     * @return mixed
     */
    public function getEnvName()
    {
        return env('APP_NAME', null);
    }

    /**
     * Return Status Debugger Server.
     *
     * @return mixed
     */
    public function getEnvDebug()
    {
        return env('APP_DEBUG', null);
    }

    /**
     * Return Environment.
     *
     * @return mixed
     */
    public function getEnvironment()
    {
        return env('APP_ENV', null);
    }

    /**
     * Return Environment URL.
     *
     * @return mixed
     */
    public function getEnvUrl()
    {
        return env('APP_URL', null);
    }
}
