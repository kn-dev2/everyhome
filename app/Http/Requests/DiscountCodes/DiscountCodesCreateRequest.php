<?php

namespace App\Http\Requests\DiscountCodes;

use Illuminate\Foundation\Http\FormRequest;

class DiscountCodesCreateRequest extends FormRequest
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
            'discount_code' => ['required', 'string', 'min:3', 'max:255', 'unique:discount_codes'],
            'amount' => ['required', 'string', 'max:255'],
            'vaild_from' => ['required'],
            'valid_till' => ['required'],
            'type'       => ['required'],
            'no_of_usage_customer' => ['required'],
            'min_spend'  => ['required']
        ];
    }
}
