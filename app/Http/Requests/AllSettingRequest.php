<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AllSettingRequest extends FormRequest
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
            'company.company_name' => ['required', 'string', 'max:255'],
            'company.company_name_kana' => ['required', 'string', 'max:255'],
            'company.address' => ['required', 'string', 'max:255'],
            'company.tel' => ['required', 'string', 'max:255'],
            'company.representative' => ['required', 'string', 'max:255'],
            'company.representative_kana' => ['required', 'string', 'max:255'],
            'company.billing.billing_name' => ['required', 'string', 'max:255'],
            'company.billing.billing_name_kana' => ['required', 'string', 'max:255'],
            'company.billing.billing_address' => ['required', 'string', 'max:255'],
            'company.billing.billing_tel' => ['required', 'string', 'max:255'],
            'company.billing.department' => ['required', 'string', 'max:255'],
            'company.billing.registered_person' => ['required', 'string', 'max:255'],
            'company.billing.registered_person_kana' => ['required', 'string', 'max:255']
        ];
    }
}
