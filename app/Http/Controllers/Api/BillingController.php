<?php

namespace App\Http\Controllers\api;

use App\Models\Billing;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    private Billing $billing;

    public function __construct(Billing $billing)
    {
        $this->billing = $billing;
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'billing_id' => ['required', 'int'],
            'billing_name' => ['required', 'string', 'max:255'],
            'billing_name_kana' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'tel' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'billing_address' => ['required', 'string', 'max:255'],
            'billing_address_kana' => ['required', 'string', 'max:255'],
        ]);

        $this->billing->fill($validated)->save();
        return ['message' => 'ok'];
    }
}
