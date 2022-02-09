<?php

namespace App\Http\Requests;

use App\Rules\AddPaymentRule;
use App\Rules\CheckRemainingAmountRule;
use Illuminate\Foundation\Http\FormRequest;

class AddPayment extends FormRequest
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
            'event_id'  =>['required'],
            'user_id'  =>['required', new AddPaymentRule($this->event_id)],
            'amount'  =>['required', new CheckRemainingAmountRule($this->event_id, $this->user_id)],
        ];
    }
}
