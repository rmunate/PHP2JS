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
            $this->user = Auth::user();
            $userArray = $this->user->except([
                'created_at',
                'updated_at',
                'email_verified_at',
                'password',
            ])->toArray();

            if (isset($this->user['id']) && !empty($this->user['id'])) {
                $this->user['id'] = Crypt::encrypt($userArray['id']);
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
