<?php

namespace App\Http\Requests\Users;

use App\Core\Models\Database\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserPasswordChangeRequest extends FormRequest
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

        $pwdIsEqual = Hash::check($this->get('actualPassword'), $user->password);

        return Auth::hasUser() && (Auth::user()->hasPermission('manage.users') || Auth::user()->allowed('manage.users', $user)) && $pwdIsEqual;
     }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'actualPassword' => 'required|between:3,255',
            'password' => 'required|confirmed|between:3,255',
        ];
    }
}
