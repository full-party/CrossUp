<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'loginId' => 'required|alpha_dash|unique:users,login_id',
            'password' => 'required|min:8|alpha_dash',
            'email' => 'required|email|max:45|unique:users,email',
            'name' => 'required|max:45'
        ];
    }
}
