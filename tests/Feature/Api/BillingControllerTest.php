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
    }
}
