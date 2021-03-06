<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Company;
use App\Http\Requests\CompanyRequest;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    private Company $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * @param  \Illuminate\Http\Request\CompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $this->company->create($request->validated());
        return ['message' => 'ok'];
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->company->findOrFail($id);
    }

    /**
     * @param int $id
     * @param  \Illuminate\Http\Request\CompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        $data = $this->company->findOrFail($id);
        $data->update($request->validated());
        return $data;
    }

    /**
     * @param int $id
     */
    public function destroy($id)
    {
        $this->company->findOrFail($id)->delete();
        return ['message' => 'ok'];
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function withBillingData($id)
    {
        return $this->company->with('billing')->findOrFail($id);
    }
}
