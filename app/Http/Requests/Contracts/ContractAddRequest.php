<?php


namespace App\Http\Requests\Contracts;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ContractAddRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return Auth::hasUser() && Auth::user()->hasPermission('manage.contracts');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required|string|between:5,190',
            'attributesList' => 'array',
            'blocks' => 'array',
            'settings' => 'array',
        ];
    }
}

