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
        return config('app.name', null);
    }

    /**
     * Return Status Debugger Server.
     *
     * @return mixed
     */
    public function getEnvDebug()
    {
        return config('app.debug', false);
    }

    /**
     * Return Environment.
     *
     * @return mixed
     */
    public function getEnvironment()
    {
        return config('app.env', null);
    }

    /**
     * Return Environment URL.
     *
     * @return mixed
     */
    public function getEnvUrl()
    {
        return config('app.url', null);
    }
}
