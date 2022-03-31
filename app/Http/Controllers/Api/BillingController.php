<?php
declare(strict_types=1);

namespace App\Http\Controllers\api;

use App\Models\Billing;
use App\Models\Company;
use App\Http\Requests\BillingRequest;
use App\Http\Controllers\Controller;

class BillingController extends Controller
{
    private Billing $billing;
    private Company $company;

    public function __construct(Billing $billing, Company $company)
    {
        $this->billing = $billing;
        $this->company = $company;
    }

    /**
     * @param  \Illuminate\Http\Request\BillingRequest  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function store(BillingRequest $request, int $id)
    {
        $company = $this->company->findOrFail($id);
        $company->billing()->create($request->validated());
        return ['message' => 'ok'];
    }

    /**
     * @param int $id
     */
    public function show(int $id)
    {
        return $this->billing->findOrFail($id);
    }

    /**
     * @param int $id
     * @param  \Illuminate\Http\Request\BillingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(BillingRequest $request, int $id)
    {
        $this->billing->findOrFail($id)->fill($request->validated())->update();

        return $this->billing->findOrFail($id);
    }

    /**
     * @param int $id
     */
    public function destroy(int $id)
    {
        $this->billing->findOrFail($id)->delete();
        return ['message' => 'ok'];
    }
}
