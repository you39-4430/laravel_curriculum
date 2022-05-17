<?php

declare(strict_types=1);

namespace App\Http\Controllers\api;

use App\Models\Billing;
use App\Models\Company;
use App\Http\Requests\AllSettingRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();
        try{
            $company = $this->company->create($params['company']);
            $company->billing()->create($params['company']['billing']);
        } catch(\Exception $e) {
            DB::rollback();
            echo "登録に失敗しました" . $e->getMessage();
        }

        return ['message' => 'ok'];
    }

    /**
     * @param int $id
     * @param  \Illuminate\Http\Request\AllSettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(AllSettingRequest $request, int $id)
    {
        $params = $request->validated();
        $company = $this->company->with('billing')->findOrFail($id);
        DB::beginTransaction();
        try {
            $company->update($params['company']);
            $company->billing->update($params['company']['billing']);
            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();
            echo "登録に失敗しました" . $e->getMessage();
        }

        return $company;
    }
}
