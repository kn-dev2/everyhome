<?php

namespace App\Http\Requests\MaidTimeSlots;

use Illuminate\Foundation\Http\FormRequest;

class MaidTimeSlotEditRequest extends FormRequest
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
            'date' => ['required'],
            'time_slot_id' => ['required'],
            'status' => ['required'],
        ];
    }
}
