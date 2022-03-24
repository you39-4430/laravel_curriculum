<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillingRequest extends FormRequest
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
            'company_id' => ['required', 'integer'],
            'billing_name' => ['required', 'string', 'max:255'],
            'billing_name_kana' => ['required', 'string', 'max:255'],
            'billing_address' => ['required', 'string', 'max:255'],
            'billing_tel' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'billing_address_name' => ['required', 'string', 'max:255'],
            'billing_address_name_kana' => ['required', 'string', 'max:255'],
        ];
    }
}
