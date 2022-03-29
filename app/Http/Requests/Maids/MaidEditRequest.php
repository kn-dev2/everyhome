<?php

namespace App\Http\Requests\Maids;

use Illuminate\Foundation\Http\FormRequest;

class MaidEditRequest extends FormRequest
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
            'email' => ['required', 'email', \Illuminate\Validation\Rule::unique('users')->ignore(request()->id)],
            'confirm_password'      => 'same:password',
            'status' =>['required']


        ];
    }
}
