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
     * @return bool
     */
    public function update(int $userId, array $parameter): bool
    {
        $user = User::find($userId);
        if ($user->count() === 0) {
            Log::error('invalid userId :' . $userId);
            return false;
        }

        // パスワードはハッシュ化する。
        $updateParameter = [];
        if (isset($parameter['password'])) {
            $updateParameter['password'] = Hash::make($parameter['password']);
        }

        return $user->fill(array_merge($updateParameter, $parameter))->save();
    }
}