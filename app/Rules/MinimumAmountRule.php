<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MinimumAmountRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $type;
    public function __construct($type)
    {
        $this->type=$type;
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

         if($this->type=='partial' && $value==''){
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
        return 'Please enter minimum partial amount';
    }
}
