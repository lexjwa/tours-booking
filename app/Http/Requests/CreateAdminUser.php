<?php

namespace App\Http\Requests;

use App\Rules\checkUniqueEmail;
use Illuminate\Foundation\Http\FormRequest;
use Sabberworm\CSS\Rule\Rule;

class CreateAdminUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'email'=>['required','email',new checkUniqueEmail()],
            'first_name'=>'required',
            'last_name'=>'required',
            'password'=>'required',
            'title'=>'required',
            'country'=>'required',
            'phone_number'=>'required',

        ];
    }
}
