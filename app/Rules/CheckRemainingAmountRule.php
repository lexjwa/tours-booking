<?php

namespace App\Rules;

use App\Booking;
use Illuminate\Contracts\Validation\Rule;

class CheckRemainingAmountRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $remaining;
    public $user_id;
    public $event;
    public function __construct($event,$user)
    {
        $this->user_id  =   $user;
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
        $booking = Booking::where(['user_id'=>$this->user_id,'event_id'=>$this->event])->first();

        $this->remaining=$booking['remaining_amount'];
        if($booking['remaining_amount']==$value){
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
        return 'Remaining Amount against event is  '.$this->remaining;
    }
}
