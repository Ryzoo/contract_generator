<?php

namespace App\Http\Requests\Users;

use App\Core\Models\Database\User;
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
        $user = User::find($this->route('id'));

        if(isset($user))
            $user->user_id = $user->id;

        return Auth::hasUser() && (Auth::user()->hasPermission('manage.users') || Auth::user()->allowed('manage.users', $user));
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
            "roles" => "array",
            "password" => "sometimes|required|between:3,255|confirmed",
        ];
    }
}
