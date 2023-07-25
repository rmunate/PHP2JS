<?php

namespace Rmunate\Php2Js\Data;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class UserPhp2Js
{
    private $user;

    /**
     * Contruct Class.
     */
    public function __construct()
    {
        $this->user = null;

        if (Auth::check()) {

            $this->user = Auth::user()->toArray();

            // Verificar y eliminar las propiedades si existen
            if (array_key_exists('created_at', $this->user)) {
                unset($this->user['created_at']);
            }
            if (array_key_exists('updated_at', $this->user)) {
                unset($this->user['updated_at']);
            }
            if (array_key_exists('email_verified_at', $this->user)) {
                unset($this->user['email_verified_at']);
            }
            if (array_key_exists('password', $this->user)) {
                unset($this->user['password']);
            }
            if (array_key_exists('id', $this->user)) {
                $this->user['id'] = Crypt::encrypt($this->user['id']);
            }
        }
    }

    /**
     * Return Data User In Session.
     *
     * @return array
     */
    public function getDataUser()
    {
        return $this->user;
    }
}
