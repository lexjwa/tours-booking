<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class BeforeStartDateOfEvent implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $startdate;

    public function __construct($startDate)
    {
        $this->startdate = $startDate;
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
        //  dd(Carbon::parse($this->startdate),Carbon::parse($value));
        if (Carbon::parse($this->startdate) <= Carbon::parse($value)) {
//            dd('start date of event is less than event reminder date');
            return false;
        } else {
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
        return 'The start date for the event reminder  must be a date before event  start date .';
    }
}
