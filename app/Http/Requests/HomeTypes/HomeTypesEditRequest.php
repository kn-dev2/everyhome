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
            'title'  => ['required', 'string', 'min:3','max:255'],
            'price'  => ['required', 'string', \Illuminate\Validation\Rule::unique('home_types')->ignore(request()->id)],
            'status' =>['required']
        ];
    }
}
