<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::hasUser() && Auth::user()->hasPermission('update.users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "firstName" => "sometimes|required|between:3,255",
            "lastName" => "sometimes|required|between:3,255",
            "email" => "sometimes|required|email|unique:users",
            "image" => "sometimes|required|image",
            "password" => "sometimes|required|between:3,255|confirmed",
        ];
    }
}
