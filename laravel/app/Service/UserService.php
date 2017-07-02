<?php

namespace App\Service;

use App\Model\User;
use Illuminate\Support\Facades\Hash;


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
        $user->password = Hash::make($parameter['password']);
        $user->email = $parameter['email'];
        $user->save();

        return $user->id;
    }
}