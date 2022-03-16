<?php

namespace Tests\Feature\Api;

use App\Models\Todo;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TodoControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
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
    public function Todoの新規作成失敗()
    {
        $params = [
            'content' => 'テスト:内容',
        ];

        $res = $this->postJson(route('api.todo.create'), $params);
        $res->assertStatus(422);
    }

    /**
     * @test
     */
    public function Todoの更新失敗()
    {
        $todo = Todo::factory()->create();
        $params = [
            'content' => 'テスト:内容更新',
        ];
        $res = $this->patchJson(route('api.todo.update', ['id' => $todo->id]), $params);
        $res->assertStatus(422);
    }

    /**
     * @test
     */
    public function Todoの更新()
    {
        $todo = Todo::factory()->create();
        $params = [
            'title' => 'テスト:タイトル更新',
            'content' => 'テスト:内容更新',
        ];
        $res = $this->patchJson(route('api.todo.update', ['id' => $todo->id]), $params);
        $res->assertOk();
        $this->assertEquals($params['title'], $res['title']);
        $this->assertEquals($params['content'], $res['content']);
    }

    /**
     * @test
     */
    public function Todoの詳細取得失敗()
    {
        $todo = Todo::factory()->create();
        $res = $this->getJson(route('api.todo.show', ['id' =>  $todo->id + 1]));
        $res->assertStatus(404);
    }

    /**
     * @test
     */
    public function Todoの詳細取得()
    {
        $todo = Todo::factory()->create();
        $params = [
            'title' => $todo->title,
            'content' => $todo->content
        ];
        $res = $this->getJson(route('api.todo.show', ['id' => $todo->id]));
        $res->assertOk();

        $this->assertEquals($params['title'], $res['title']);
        $this->assertEquals($params['content'], $res['content']);
    }

    /**
     * @test
     */
    public function Todoの削除失敗()
    {
        $todo = Todo::factory()->create();
        $res = $this->deleteJson(route('api.todo.delete', ['id' => $todo->id + 1]));
        $res->assertStatus(404);

        $todos = Todo::all();
        $this->assertCount(1, $todos);
    }

    /**
     * @test
     */
    public function Todoの削除()
    {
        $todo = Todo::factory()->create();
        $res = $this->deleteJson(route('api.todo.delete', ['id' => $todo->id]));
        $res->assertOk();

        $todos = Todo::all();
        $this->assertCount(0, $todos);
    }
}
