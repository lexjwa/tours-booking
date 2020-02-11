<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignRequest extends FormRequest
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
            'detail'=>'required',
            'campaign_type'=>'required',

        ];
    }
    public function messages()
    {
        return [
            'campaign_type.required' => 'Please select one of the above campaign type.',

        ];
    }
}
