<?php

namespace App\Model;

use Hash;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package App\Model
 */
class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login_id', 'email', 'password'
    ];

    /**
     * パスワード登録時にハッシュ化する
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}