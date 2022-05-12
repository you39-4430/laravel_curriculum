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
        $params = $request->validated();
        $company = $this->company->create($params['company']);
        $company->billing()->create($params['company']['billing']);
        return ['message' => 'ok'];
    }

    /**
     * @param int $id
     * @param  \Illuminate\Http\Request\AllSettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(AllSettingRequest $request, int $id)
    {
        $company = $this->company->with('billing')->findOrFail($id);
        $params = $request->validated();
        $company->update($params['company']);
        $company->billing->update($params['company']['billing']);
        return $company;
    }

}
