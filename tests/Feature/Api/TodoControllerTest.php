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
            'content' => 'テスト:内容',
        ];

        $res = $this->postJson(route('api.todo.create'), $params);
        $res->assertOk();
        $todos = Todo::all();

        $this->assertCount(1, $todos);
        $todo = $todos->first();
        $this->assertEquals($params['title'], $todo->title);
        $this->assertEquals($params['content'], $todo->content);

    }

    /**
     * @test
     */
    public function Todoの更新()
    {
        Todo::factory()->count(1)->create();
        $todos = Todo::all();
        $data = $todos->first();
        $id = $data->id;
        $params = [
            'title' => 'テスト:タイトル更新',
            'content' => 'テスト:内容更新',
        ];
        $res = $this->postJson(route('api.todo.update',['id'=>$id]), $params);
        $res->assertOk();

        $todos = Todo::all();
        $this->assertCount(1, $todos);
        $todo = $todos->first();
        $this->assertEquals($params['title'], $todo->title);
        $this->assertEquals($params['content'], $todo->content);
    }

        /**
     * @test
     */
    public function Todoの詳細取得()
    {
        Todo::factory()->count(1)->create();
        $todos = Todo::all();
        $data = $todos->first();
        $id = 1;
        $params = [
            'title' => $data->title,
            'content' => $data->content
        ];
        $res = $this->postJson(route('api.todo.show',['id'=>$id]));
        $res->assertOk();

        $todos = Todo::all();
        $this->assertCount(1, $todos);
        $this->assertEquals($params['title'], $res['title']);
        $this->assertEquals($params['content'], $res['content']);
    }
}
