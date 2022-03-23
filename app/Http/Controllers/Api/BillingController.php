<?php

namespace App\Http\Controllers\api;

use App\Models\Billing;
use App\Http\Requests\BillingRequest;
use App\Http\Controllers\Controller;

class BillingController extends Controller
{
    private Billing $billing;

    public function __construct(Billing $billing)
    {
        $this->billing = $billing;
    }

    /**
     * @param  \Illuminate\Http\Request\BillingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BillingRequest $request)
    {
        $validated = $request->all();

        $this->billing->fill($validated)->save();
        return ['message' => 'ok'];
    }

    /**
     * @param int $id
     */
    public function show($id)
    {
        return $this->billing->findOrFail($id);
    }

    /**
     * @param int $id
     * @param  \Illuminate\Http\Request\BillingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(BillingRequest $request, $id)
    {
        $validated = $request->all();
        $this->billing->findOrFail($id)->fill($validated)->update();
        return $this->billing->findOrFail($id);
    }

    /**
     * @param int $id
     */
    public function destroy($id)
    {
        $this->billing->findOrFail($id)->delete;
        return ['message' => 'ok'];
    }
}
