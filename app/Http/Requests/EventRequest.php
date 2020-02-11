<?php

namespace App\Http\Requests;

use App\Rules\AfterEndDateOfEvent;
use App\Rules\AfterReminderStartDate;
use App\Rules\BeforeStartDateOfEvent;
use App\Rules\checkminimuamount;
use App\Rules\MinimumAmountRule;
use App\Rules\ValidationSchedularRule;
use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'title' =>  'required',
            'cost'  =>  'required',
            'description'   =>  'required|max:200',
            'start_date'    =>  'required|date|after:today',
            'end_date'      =>  'required|date|after:today',
            'number_of_days'    =>  'required',
            'payment_type'  =>  'required',
            'minimum_amount'    =>  new MinimumAmountRule($this->payment_type),
            'start_time'    =>  'required',
            'end_time'      =>  'required',

             'start_date_for_day'=>['nullable','date','after:today',new BeforeStartDateOfEvent($this->start_date)],
            'end_date_for_day'=>['nullable','date','after:today',new AfterEndDateOfEvent($this->start_date),new AfterReminderStartDate($this->start_date_for_day)]
        ];
    }
}
