<?php

namespace App\Rules;

use App\Booking;
use Illuminate\Contracts\Validation\Rule;

class AddPaymentRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $event;
    public function __construct($event)
    {
        $this->event    =   $event;
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
        $booking = Booking::where(['user_id'=>$value,'event_id'=>$this->event])->count();
        if($booking>0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid payment.';
    }
}
