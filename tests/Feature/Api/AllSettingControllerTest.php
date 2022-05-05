<?php

namespace Tests\Feature\Api;

use App\Models\Company;
use App\Models\Billing;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AllSettingControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function 会社情報・請求情報登録テスト失敗()
    {
        $params = [
            'company_name' => '株式会社 鈴木',
            'company_name_kana' => 'カブシキガイシャ スズキ',
        ];
        $res = $this->postJson(route('api.all.create'),$params);
        $res->assertStatus(422);
    }

    /**
     *  @test
     */
    public function 会社情報・請求情報登録テスト()
    {
        $params = [
            'company_name' => '株式会社 鈴木',
            'company_name_kana' => 'カブシキガイシャ スズキ',
            'address' => '東京都東京区東京 1-1-1',
            'tel' => '090-1234-5678',
            'representative' => '鈴木 太郎',
            'representative_kana' => 'スズキ タロウ',
            'billing_name' => '株式会社 佐藤',
            'billing_name_kana' => 'カブシキガイシャ サトウ',
            'billing_address' => '東京都東京区東京 1-1-1',
            'billing_tel' => '090-1234-5678',
            'department' => '営業部',
            'registered_person' => '佐藤 太郎',
            'registered_person_kana' => 'サトウ タロウ'
        ];
        $res = $this->postJson(route('api.all.create'), $params);
        $res->assertOk();

        $companies = Company::all();
        $billings = Billing::all();
        $this->assertCount(1, $companies);
        $this->assertCount(1, $billings);
        $company = Company::first();
        $billing = Billing::first();
        $this->assertEquals($params['company_name'], $company->company_name);
        $this->assertEquals($params['company_name_kana'], $company->company_name_kana);
        $this->assertEquals($params['address'], $company->address);
        $this->assertEquals($params['tel'], $company->tel);
        $this->assertEquals($params['representative'], $company->representative);
        $this->assertEquals($params['representative_kana'], $company->representative_kana);
        $this->assertEquals($params['billing_name'], $billing->billing_name);
        $this->assertEquals($params['billing_name_kana'], $billing->billing_name_kana);
        $this->assertEquals($params['billing_address'], $billing->billing_address);
        $this->assertEquals($params['billing_tel'], $billing->billing_tel);
        $this->assertEquals($params['department'], $billing->department);
        $this->assertEquals($params['registered_person'], $billing->registered_person);
        $this->assertEquals($params['registered_person_kana'], $billing->registered_person_kana);
    }
}
