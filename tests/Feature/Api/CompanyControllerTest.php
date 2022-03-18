<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function 会社情報を登録できる()
    {
        $params = [
            'company_name' => '株式会社 鈴木',
            'company_name_kana' => 'カブシキガイシャ スズキ',
            'address' => '東京都東京区東京 1-1-1',
            'tel' => '090-1234-5678',
            'representative' => '鈴木 太郎',
            'representative_kana' => 'スズキ タロウ',
        ];
        $res = $this->postJson(route('api.company.create'),$params);
        $res->assertStatus(200);
    }
}
