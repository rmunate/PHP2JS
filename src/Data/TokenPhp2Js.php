<?php

namespace Rmunate\Php2Js\Data;

class TokenPhp2Js
{
    /**
     * Return csrf_token Laravel.
     *
     * @return string
     */
    public function csrfToken()
    {
        return csrf_token();
    }

    /**
     * Return csrf_token Laravel.
     *
     * @return string
     */
    public function csrfTokenCookie()
    {
        return $_COOKIE['XSRF-TOKEN'] ?? null;
    }
}
