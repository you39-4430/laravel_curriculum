<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use App\Http\Requests\CompanyRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private Company $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * @param  \Illuminate\Http\Request  $request
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
    public function show(int $id)
    {
        $company = $this->company->findOrFail($id);
        return $company;
    }
}
