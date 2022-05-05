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


}
