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
        return ['message' => 'ok'];
    }

}
