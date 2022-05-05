<?php
declare(strict_types=1);

namespace App\Http\Controllers\api;

use App\Models\Billing;
use App\Models\Company;
use App\Http\Requests\AllSettingRequest;
use App\Http\Controllers\Controller;

class AllSettingController extends Controller
{
    private Billing $billing;
    private Company $company;

    public function __construct(Billing $billing, Company $company)
    {
        $this->billing = $billing;
        $this->company = $company;
    }

    /**
     * @param  \Illuminate\Http\Request\AllSettingRequest  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function store(AllSettingRequest $request)
    {
        $company = $this->company->create($request->validated('company_name', 'company_name_kana', 'address', 'tel', 'representative', 'representative_kana'));
        $company->billing()->create($request->validated('billing_name', 'billing_name_kana', 'billing_address', 'billing_tel', 'department', 'registered_person', 'registered_person_kana'));
        return ['message' => 'ok'];
    }

}
