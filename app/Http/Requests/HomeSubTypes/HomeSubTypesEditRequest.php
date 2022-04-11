<?php

namespace App\Http\Requests\HomeSubTypes;

use Illuminate\Foundation\Http\FormRequest;

class HomeSubTypesEditRequest extends FormRequest
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
            'home_type_id' => ['required'],
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'price' => ['required', 'string'],
            'min'  => ['required', 'numeric'],
            'status' => ['required']

        ];
    }
}
