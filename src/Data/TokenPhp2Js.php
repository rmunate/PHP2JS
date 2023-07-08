<?php

namespace Rmunate\Php2Js\Data;

class TokenPhp2Js
{
    /**
     * Return csrf_token Laravel.
     *
     * @return string
     */
    public function csrfToken(): string
    {
        return csrf_token();
    }
}
