<?php

namespace App\Http\Requests\HomeTypes;

use Illuminate\Foundation\Http\FormRequest;

class HomeTypesEditRequest extends FormRequest
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
            'service_id' => ['required', 'numeric'],
            'title'  => ['required', 'string', 'min:3','max:255',\Illuminate\Validation\Rule::unique('home_types')->ignore(request()->id)],
            'price'  => ['required', 'string'],
            'hour' => ['required', 'numeric'],
            'min' => ['required', 'numeric'],
            'status' =>['required']
        ];
    }
}
