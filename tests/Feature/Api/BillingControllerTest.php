<?php

namespace Tests\Feature\Api;

use App\Models\Billing;
use App\Models\Company;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BillingControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     *  @test
     */
    public function 請求先情報登録テスト失敗()
    {
        $company = Company::factory()->create();
        $params = [
            'billing_address' => '佐藤 太郎',
            'billing_address_kana' => 'サトウ タロウ'
        ];
        $res = $this->postJson(route('api.billing.create'), $params);
        $res->assertStatus(422);
    }
    /**
     *  @test
     */
    public function 請求先情報登録テスト()
    {
        $company = Company::factory()->create();
        $params = [
            'billing_id' => $company->id,
            'billing_name' => '株式会社 佐藤',
            'billing_name_kana' => 'カブシキガイシャ サトウ',
            'address' => '東京都東京区東京 1-1-1',
            'tel' => '090-1234-5678',
            'department' => '営業部',
            'billing_address' => '佐藤 太郎',
            'billing_address_kana' => 'サトウ タロウ'
        ];
        $res = $this->postJson(route('api.billing.create'), $params);
        $res->assertOk();

        $billings = Billing::all();
        $this->assertCount(1, $billings);
        $billing = $billings->first();
        $this->assertEquals($params['billing_id'], $billing->billing_id);
        $this->assertEquals($params['billing_name'], $billing->billing_name);
        $this->assertEquals($params['billing_name_kana'], $billing->billing_name_kana);
        $this->assertEquals($params['address'], $billing->address);
        $this->assertEquals($params['tel'], $billing->tel);
        $this->assertEquals($params['department'], $billing->department);
        $this->assertEquals($params['billing_address'], $billing->billing_address);
        $this->assertEquals($params['billing_address_kana'], $billing->billing_address_kana);
    }
}
