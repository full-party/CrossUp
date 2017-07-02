<?php

namespace App\Model;

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
        'login_id', 'password', 'email'
    ];
}