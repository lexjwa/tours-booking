<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class AfterEndDateOfEvent implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $eventEnd;
    public function __construct($eventEnd)
    {
        $this->eventEnd=$eventEnd;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(Carbon::parse($this->eventEnd)<=Carbon::parse($value)){
//            dd('start date of event is less than event reminder date');
            return false;
        }else{
            return true;
            //    dd('olta');
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The end date for the event reminder  must be a date before event  start date .';
    }
}
