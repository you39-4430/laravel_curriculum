<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'company_name_kana' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'tel' => ['required', 'string', 'max:255'],
            'representative' => ['required', 'string', 'max:255'],
            'representative_kana' => ['required', 'string', 'max:255'],
        ]);

        $this->company->fill($validated)->save();
        return ['message' => 'ok'];
    }
}
