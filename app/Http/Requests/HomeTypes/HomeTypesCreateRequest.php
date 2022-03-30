<?php

namespace App\Http\Requests\HomeTypes;

use Illuminate\Foundation\Http\FormRequest;

class HomeTypesCreateRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:3', 'max:255', 'unique:home_types'],
            'price' => ['required', 'string', 'max:255'],
            'status' => ['required']

        ];
    }
}
