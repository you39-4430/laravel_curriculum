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


}
