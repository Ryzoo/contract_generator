<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::hasUser() && Auth::user()->hasPermission('create.users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "firstName" => "required|between:3,255",
            "lastName" => "required|between:3,255",
            "email" => "required|email|unique:users",
            "password" => "required|between:3,255|confirmed",
        ];
    }
}
