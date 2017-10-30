<?php

namespace App\Service;

use App\Model\User;
use Illuminate\Support\Facades\Hash;
use Log;


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

    /**
     * @param string $loginId
     * @return mixed
     */
    public function find(string $loginId)
    {
        return User::where('login_id', $loginId)->first();
    }

    /**
     * @param int $userId
     * @param array $parameter
     * @return int
     */
    public function update(int $userId, array $parameter): int
    {
        User::find($userId)->fill($parameter)->save();
        return $userId;
    }

    /**
     * 指定ユーザー以外の値重複チェック
     *
     * @param int $userId
     * @param string $column
     * @param string $value
     * @return bool
     */
    public function checkDuplicate(int $userId, string $column, string $value): bool
    {
        $user = User::where([
            ['id', '!=', $userId],
            [$column, $value]
        ]);

        return $user->count() > 0;
    }
}