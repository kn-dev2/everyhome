<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class CustomerProfileRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3','max:255'],
            'phone' => ['required', 'numeric'],
            'suite' => ['required', 'string', 'min:3','max:255'],
            'city' => ['required', 'string', 'min:3','max:255'],
            'state' => ['required', 'numeric'],
            'zipcode' => ['required', 'numeric'],
            'address' => ['required', 'string', 'min:3','max:255'],

        ];
    }
}
