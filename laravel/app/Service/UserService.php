<?php

namespace App\Service;

use App\Model\User;

/**
 * Class UserService
 * @package App\Service
 */
class UserService
{
    /**
     * @param array $parameter
     * @return int
     */
    public function store(array $parameter): int
    {
        $user = new User();
        $user->login_id = $parameter['loginId'];
        $user->name = $parameter['name'];
        $user->email = $parameter['email'];
        $user->save();

        return $user->id;
    }
}