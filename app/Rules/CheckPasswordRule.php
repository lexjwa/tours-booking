<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CheckPasswordRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $id;

    public $newPassword;

    public function __construct($id, $newPassword)
    {
        $this->id = $id;
        $this->newPassword = $newPassword;
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
        if ($value || $this->newPassword) {
            $current_password = Auth::user()->password;
            if (\Illuminate\Support\Facades\Hash::check($value, $current_password)) {
                return true;
            } else {
                return false;
            }
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
        return 'Old  Password is not correct Or New Password field Is not filled Or Old Password Field Is not Filled.';
    }
}
