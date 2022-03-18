<?php

namespace Tests\Feature\Api;

use App\Models\Company;
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
}
