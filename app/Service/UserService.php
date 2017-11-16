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
        return User::create($parameter)->id;
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
     * Usersテーブルのデータに対し、指定ユーザー以外の重複チェックを行う。
     * メールアドレス重複チェックなど、ログインユーザー以外の存在チェックで利用する。
     *
     * @param int $userId
     * @param string $column
     * @param string $value
     * @return bool
     */
    public function checkDuplicate(int $userId, string $column, string $value): bool
    {
        // 指定ユーザー以外に、カラムとバリューのセットが存在すればtrueを返す。
        $user = User::where([
            ['id', '!=', $userId],
            [$column, $value]
        ]);

        return $user->count() > 0;
    }
}