<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class AfterReminderStartDate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $startDate;
    public function __construct($startDate)
    {
        $this->startDate=$startDate;
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
        if(Carbon::parse($value)>=Carbon::parse($this->startDate)){
            return false;
        }else{
           return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The event reminder end   date must be before event  reminder start date.';
    }
}
