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
        $create = [
            'title' => 'テスト:タイトル',
            'content' => 'テスト:内容',
        ];

        $this->postJson(route('api.todo.create'), $create);
        $todos = Todo::all();
        $data = $todos->last();
        $id = $data->id;
        $updates = [
            'id' => $id,
            'title' => 'テスト:タイトル更新',
            'content' => 'テスト:内容更新',
        ];
        $res = $this->postJson(route('api.todo.update'),$updates);
        $res->assertOk();
        $todos = Todo::all();
        $this->assertCount(1, $todos);
        $todo = $todos->first();
        $this->assertEquals($updates['title'], $todo->title);
        $this->assertEquals($updates['content'], $todo->content);
    }

    /**
     * @test
     */
    public function Todoの詳細情報取得()
    {
        $create = [
            'title' => 'テスト:タイトル',
            'content' => 'テスト:内容',
        ];

        $this->postJson(route('api.todo.create'), $create);
        $todos = Todo::all();
        $res = $this->postJson(route('api.todo.update'));
        $res->assertOk();
    }

    /**
     * @test
     */
    public function Todoの削除()
    {

        $create = [
            'title' => 'テスト:タイトル',
            'content' => 'テスト:内容',
        ];

        $this->postJson(route('api.todo.create'), $create);
        $todos = Todo::all();
        $data = $todos->last();
        $todo_id = $data->id;
        $params = [
            'id' => $todo_id
        ];
        $res = $this->postJson(route('api.todo.delete'),$params);
        $res->assertOk();
        $todos = Todo::all();
        $this->assertCount(0, $todos);
    }
}
