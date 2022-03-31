<?php

namespace App\Http\Requests\ExtraServices;

use Illuminate\Foundation\Http\FormRequest;

class ExtraServicesCreateRequest extends FormRequest
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
            'type' => ['required', 'string'],
            'service_id' => ['required', 'numeric'],
            'title' => ['required', 'string', 'min:3', 'max:255', 'unique:extra_services'],
            'icon' => ['required', 'mimes:jpg,jpeg,png'],
            'price' => ['required', 'string'],
            'status' => ['required']
        ];
    }
}
