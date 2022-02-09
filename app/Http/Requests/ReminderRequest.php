<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReminderRequest extends FormRequest
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
            'event_id'      =>  'required',
            'day_after_day' =>  'required|in:0,1',
            'weekly'        =>  'required|in:0,1',
            'monthly'        =>  'required|in:0,1',
        ];
    }
}
