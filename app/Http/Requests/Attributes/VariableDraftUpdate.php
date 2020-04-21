<?php

namespace App\Http\Requests\Attributes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class VariableDraftUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      return Auth::hasUser() && Auth::user()->hasPermission('manage.library.attributes');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'name' => 'required|string|min:3|max:255',
          'description' => 'required|string|min:3|max:255',
          'category' => 'required|string|min:3|max:255',
          'content' => 'required|json',
        ];
    }
}
