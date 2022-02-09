<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidationSchedularRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $start;

    public $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
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
        if ($value == true || $value == '') {
            return false;
        } else {
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
        return 'The validation error message.';
    }
}
