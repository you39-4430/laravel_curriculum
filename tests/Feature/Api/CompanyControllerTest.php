<?php

namespace Tests\Feature\Api;

use App\Models\Company;
use App\Models\Billing;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CompanyControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function 会社情報登録テスト失敗()
    {
        $params = [
            'company_name' => '株式会社 鈴木',
            'company_name_kana' => 'カブシキガイシャ スズキ',
        ];
        $res = $this->postJson(route('api.company.create'),$params);
        $res->assertStatus(422);
    }

    /**
     *  @test
     */
    public function 会社情報登録テスト()
    {
        $params = [
            'company_name' => '株式会社 鈴木',
            'company_name_kana' => 'カブシキガイシャ スズキ',
            'address' => '東京都東京区東京 1-1-1',
            'tel' => '090-1234-5678',
            'representative' => '鈴木 太郎',
            'representative_kana' => 'スズキ タロウ'
        ];
        $res = $this->postJson(route('api.company.create'), $params);
        $res->assertOk();

        $companies = Company::all();
        $this->assertCount(1, $companies);
        $company = $companies->first();
        $this->assertEquals($params['company_name'], $company->company_name);
        $this->assertEquals($params['company_name_kana'], $company->company_name_kana);
        $this->assertEquals($params['address'], $company->address);
        $this->assertEquals($params['tel'], $company->tel);
        $this->assertEquals($params['representative'], $company->representative);
        $this->assertEquals($params['representative_kana'], $company->representative_kana);
    }

    /**
     * @test
     */
    public function 会社情報取得テスト失敗()
    {
        $company = Company::factory()->create();
        $res = $this->getJson(route('api.company.show', $company->id + 1));
        $res->assertStatus(404);
    }

    /**
     * @test
     */
    public function 会社情報取得テスト()
    {
        $company = Company::factory()->create();
        $params = [
            'company_name' => $company->company_name,
            'company_name_kana' => $company->company_name_kana,
            'address' => $company->address,
            'tel' => $company->tel,
            'representative' => $company->representative,
            'representative_kana' => $company->representative_kana
        ];
        $res = $this->getJson(route('api.company.show', $company->id));
        $res->assertOk();

        $this->assertEquals($params['company_name'], $res['company_name']);
        $this->assertEquals($params['company_name_kana'], $res['company_name_kana']);
        $this->assertEquals($params['address'], $res['address']);
        $this->assertEquals($params['tel'], $res['tel']);
        $this->assertEquals($params['representative'], $res['representative']);
        $this->assertEquals($params['representative_kana'], $res['representative_kana']);
    }

    /**
     * @test
     */
    public function 会社情報更新テスト失敗()
    {
        $company = Company::factory()->create();
        $params = [
            'company_name' => '株式会社 鈴木',
            'company_name_kana' => 'カブシキガイシャ スズキ',
        ];
        $res = $this->putJson(route('api.company.update', $company->id), $params);
        $res->assertStatus(422);
    }
    /**
     * @test
     */
    public function 会社情報更新テスト()
    {
        $company = Company::factory()->create();
        $params = [
            'company_name' => '株式会社 鈴木',
            'company_name_kana' => 'カブシキガイシャ スズキ',
            'address' => '1111111 東京都東京区東京 1-1-1',
            'tel' => '01209876543',
            'representative' => '鈴木 太郎',
            'representative_kana' => 'スズキ タロウ'
        ];
        $res = $this->putJson(route('api.company.update', $company->id), $params);
        $res->assertOk();

        $this->assertEquals($params['company_name'], $res['company_name']);
        $this->assertEquals($params['company_name_kana'], $res['company_name_kana']);
        $this->assertEquals($params['address'], $res['address']);
        $this->assertEquals($params['tel'], $res['tel']);
        $this->assertEquals($params['representative'], $res['representative']);
        $this->assertEquals($params['representative_kana'], $res['representative_kana']);
    }

    /**
     * @test
     */
    public function 会社情報削除テスト失敗()
    {
        Billing::factory()->create();
        $company = Company::all()->first();

        $res = $this->deleteJson(route('api.company.delete', $company->id + 1));
        $res->assertStatus(404);
    }

    /**
     * @test
     */
    public function 会社情報削除テスト()
    {
        Billing::factory()->create();
        $company = Company::all()->first();
        $res = $this->deleteJson(route('api.company.delete', $company->id));
        $res->assertOk();

        $companies = Company::all();
        $billings = Billing::all();
        $this->assertCount(0, $companies);
        $this->assertCount(0, $billings);
    }

    /**
     * @test
     */
    public function 会社情報・請求先情報取得テスト失敗()
    {
        Billing::factory()->create();
        $company = Company::all()->first();
        $res = $this->getJson(route('api.company.formattedResponseBody', $company->id + 1));
        $res->assertStatus(404);
    }

    /**
     * @test
     */
    public function 会社情報・請求先情報取得テスト()
    {
        Billing::factory()->create();
        $company = Company::all()->first();
        $billing = Billing::all()->first();
        $res = $this->getJson(route('api.company.formattedResponseBody', $company->id));
        $res->assertOk();

        $this->assertEquals($company->company_name, $res['company_name']);
        $this->assertEquals($company->company_name_kana, $res['company_name_kana']);
        $this->assertEquals($company->address, $res['address']);
        $this->assertEquals($company->tel, $res['tel']);
        $this->assertEquals($company->representative, $res['representative']);
        $this->assertEquals($company->representative_kana, $res['representative_kana']);
        $this->assertEquals($billing->company_id, $res['billing']['company_id']);
        $this->assertEquals($billing->billing_name, $res['billing']['billing_name']);
        $this->assertEquals($billing->billing_name_kana, $res['billing']['billing_name_kana']);
        $this->assertEquals($billing->address, $res['billing']['address']);
        $this->assertEquals($billing->tel, $res['billing']['tel']);
        $this->assertEquals($billing->department, $res['billing']['department']);
        $this->assertEquals($billing->billing_address, $res['billing']['billing_address']);
        $this->assertEquals($billing->billing_address_kana, $res['billing']['billing_address_kana']);
    }
}
