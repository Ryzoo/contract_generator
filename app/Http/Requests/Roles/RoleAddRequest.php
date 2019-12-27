<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RoleAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::hasUser() && Auth::user()->hasPermission('manage.roles');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required|string|between:3,255",
            "slug" => "required|string|unique:roles|between:3,255",
            "description" => "string|between:3,255",
            "level" => "numeric|between:0,10",
            "permission" => "array",
        ];
    }
}
