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
            'company_id' => $company->id + 1,
            'billing_name' => '株式会社 佐藤',
            'billing_name_kana' => 'カブシキガイシャ サトウ',
            'billing_address' => '東京都東京区東京 1-1-1',
            'billing_tel' => '090-1234-5678',
            'department' => '営業部',
            'billing_address_name' => '佐藤 太郎',
            'billing_address_name_kana' => 'サトウ タロウ'
        ];
        $res = $this->postJson(route('api.billing.create'), $params);
        $res->assertStatus(500);
    }

    /**
     *  @test
     */
    public function 請求先情報登録テスト()
    {
        $company = Company::factory()->create();
        $params = [
            'company_id' => $company->id,
            'billing_name' => '株式会社 佐藤',
            'billing_name_kana' => 'カブシキガイシャ サトウ',
            'billing_address' => '東京都東京区東京 1-1-1',
            'billing_tel' => '090-1234-5678',
            'department' => '営業部',
            'billing_address_name' => '佐藤 太郎',
            'billing_address_name_kana' => 'サトウ タロウ'
        ];
        $res = $this->postJson(route('api.billing.create'), $params);
        $res->assertOk();

        $billings = Billing::all();
        $this->assertCount(1, $billings);
        $billing = $billings->first();
        $this->assertEquals($params['company_id'], $billing->company_id);
        $this->assertEquals($params['billing_name'], $billing->billing_name);
        $this->assertEquals($params['billing_name_kana'], $billing->billing_name_kana);
        $this->assertEquals($params['billing_address'], $billing->billing_address);
        $this->assertEquals($params['billing_tel'], $billing->billing_tel);
        $this->assertEquals($params['department'], $billing->department);
        $this->assertEquals($params['billing_address_name'], $billing->billing_address_name);
        $this->assertEquals($params['billing_address_name_kana'], $billing->billing_address_name_kana);
    }

    /**
     *  @test
     */
    public function 請求先情報取得テスト失敗()
    {
        $billing = Billing::factory()->create();
        $res = $this->getJson(route('api.billing.show',$billing->billing_id + 1));
        $res->assertStatus(404);
    }

    /**
     *  @test
     */
    public function 請求先情報取得テスト()
    {
        $billing = Billing::factory()->create();
        $params = [
            'company_id' => $billing->company_id,
            'billing_name' => $billing->billing_name,
            'billing_name_kana' => $billing->billing_name_kana,
            'billing_address' => $billing->billing_address,
            'billing_tel' => $billing->billing_tel,
            'department' => $billing->department,
            'billing_address_name' => $billing->billing_address_name,
            'billing_address_name_kana' => $billing->billing_address_name_kana
        ];
        $res = $this->getJson(route('api.billing.show',$billing->billing_id));
        $res->assertOk();

        $this->assertEquals($params['company_id'], $res['company_id']);
        $this->assertEquals($params['billing_name'], $res['billing_name']);
        $this->assertEquals($params['billing_name_kana'], $res['billing_name_kana']);
        $this->assertEquals($params['billing_address'], $res['billing_address']);
        $this->assertEquals($params['billing_tel'], $res['billing_tel']);
        $this->assertEquals($params['department'], $res['department']);
        $this->assertEquals($params['billing_address_name'], $res['billing_address_name']);
        $this->assertEquals($params['billing_address_name_kana'], $res['billing_address_name_kana']);
    }

    /**
     *  @test
     */
    public function 請求先情報更新テスト失敗()
    {
        $billing  = Billing::factory()->create();
        $params = [
            'billing_name' => '株式会社 田中',
            'billing_name_kana' => 'カブシキガイシャ タナカ',
        ];

        $res = $this->putJson(route('api.billing.update', $billing->billing_id), $params);
        $res->assertStatus(422);
    }

    /**
     *  @test
     */
    public function 請求先情報更新テスト()
    {
        $billing  = Billing::factory()->create();
        $params = [
            'company_id' => $billing->company_id,
            'billing_name' => '株式会社 田中',
            'billing_name_kana' => 'カブシキガイシャ タナカ',
            'billing_address' => '0000000 東京都東京区東京 1-1-1',
            'billing_tel' => '01098761234',
            'department' => '総務部',
            'billing_address_name' => '田中 太郎',
            'billing_address_name_kana' => 'タナカ タロウ'
        ];

        $res = $this->putJson(route('api.billing.update', $billing->billing_id), $params);
        $res->assertOk();

        $this->assertEquals($params['company_id'], $res['company_id']);
        $this->assertEquals($params['billing_name'], $res['billing_name']);
        $this->assertEquals($params['billing_name_kana'], $res['billing_name_kana']);
        $this->assertEquals($params['billing_address'], $res['billing_address']);
        $this->assertEquals($params['billing_tel'], $res['billing_tel']);
        $this->assertEquals($params['department'], $res['department']);
        $this->assertEquals($params['billing_address_name'], $res['billing_address_name']);
        $this->assertEquals($params['billing_address_name_kana'], $res['billing_address_name_kana']);

    }

    /**
     *  @test
     */
    public function 請求先情報削除テスト失敗()
    {
        $billing  = Billing::factory()->create();

        $res = $this->deleteJson(route('api.billing.delete', $billing->billing_id + 1));
        $res->assertStatus(404);
    }

    /**
     *  @test
     */
    public function 請求先情報削除テスト()
    {
        $billing  = Billing::factory()->create();

        $res = $this->deleteJson(route('api.billing.delete', $billing->billing_id));
        $res->assertOk();

        $companies = Company::all();
        $billings = Billing::all();
        $this->assertCount(1, $companies);
        $this->assertCount(0, $billings);
    }
}
