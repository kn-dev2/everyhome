<?php

namespace App\Http\Requests\TimeSlots;

use Illuminate\Foundation\Http\FormRequest;

class TimeSlotEditRequest extends FormRequest
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
            'slot' => ['required', 'string', \Illuminate\Validation\Rule::unique('time_slots')->ignore(request()->id)],
            'status' =>['required']
        ];
    }
}
