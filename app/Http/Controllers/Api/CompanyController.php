<?php

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
        $params = $request->all();

        $this->company->fill($params)->save();
        return ['message' => 'ok'];
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = $this->company->findOrFail($id);
        return $company;
    }

    /**
     * @param int $id
     * @param  \Illuminate\Http\Request\CompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        $params = $request->all();
        $this->company->findOrFail($id)->fill($params)->update();
        $company = $this->company->findOrFail($id);

        return $company;
    }

    /**
     * @param int $id
     */
    public function destroy($id)
    {
        $this->company->findOrFail($id)->delete();
        return ['message' => 'ok'];

    }
}
