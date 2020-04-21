<?php

namespace App\Http\Requests\Attributes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class VariableDraftDelete extends FormRequest
{
    public function authorize()
    {
      return Auth::hasUser() && Auth::user()->hasPermission('manage.library.attributes');
    }

    public function rules()
    {
        return [];
    }
}
