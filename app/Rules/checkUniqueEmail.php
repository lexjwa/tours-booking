<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;

class checkUniqueEmail implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
       $user=User::where(['email'=>$value,'authority'=>'admin'])->count();
       if($user==0){
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
        return 'The email already taken.';
    }
}
