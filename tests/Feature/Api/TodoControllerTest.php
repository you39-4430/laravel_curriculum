<?php

namespace Tests\Feature\Api;

use App\Models\Todo;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TodoControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp():void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function Todoの新規作成()
    {
        $params = [
            'title' => 'テスト:タイトル',
        ];

        $res = $this->postJson(route('api.todo.create'), $params);
        $res->assertOk();
        $todos = Todo::all();

        $this->assertCount(2, $todos);

        $todo = $todos->first();
        $this->assertEquals($params['title'], $todo->title);
        $this->assertEquals($params['content'], $todo->content);

    }


}
