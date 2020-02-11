<?php

namespace App\Http\Requests;

use App\Rules\CheckRemainingAmountRule;
use App\Rules\ManualPaymentRule;
use Illuminate\Foundation\Http\FormRequest;

class addmanualpayment extends FormRequest
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
            'user_id'   =>  'required',
            'event_id'  =>  'required',
            'amount'    =>  ['required',new ManualPaymentRule($this->event_id)]
        ];
    }
    public function messages()
    {
       return[
           'user_id.required' => 'User field is required.',
           'event_id.required' => 'Event field is required.',
       ];
    }
}
