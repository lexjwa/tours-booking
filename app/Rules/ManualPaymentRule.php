<?php

namespace App\Rules;

use App\Event;
use Illuminate\Contracts\Validation\Rule;

class ManualPaymentRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $event;
    public $cost;
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
        $event  =   Event::where('id',$this->event)->first();
        $this->cost =   $event->cost;
        if($event->cost>=$value){
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
        return 'event cost is '.$this->cost;
    }
}
