@extends('layouts.app')

@section('content')
<div class="mt-20 mb-10 flex justify-between">
    <h1 class="text-base">TODO一覧</h1>
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        <a href="{{ route('todo.create') }}">新規追加</a>
    </button>
    </div>
    <div>
    <table class="table-auto">
        <thead>
        <tr>
            <th class="px-4 py-2">タイトル</th>
            <th class="px-4 py-2">やること</th>
            <th class="px-4 py-2">作成日時</th>
            <th class="px-4 py-2">更新日時</th>
        </tr>
        </thead>
        <tbody>
            @foreach($todos as $todo)
            <tr>
                <td class="border px-4 py-2">{{ $todo->title }}</td>
                <td class="border px-4 py-2">{{ $todo->content }}</td>
                <td class="border px-4 py-2">{{ $todo->created_at }}</td>
                <td class="border px-4 py-2">{{ $todo->updated_at }}</td>
                <td class="border px-4 py-2">
                    <a
                        class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow"
                        href="{{ route('todo.edit', $todo->id) }}"
                    >
                        編集
                    </a>
                </td>
                {!! Form::open(['method' => 'delete', 'route' => ['todo.destroy', $todo->id]]) !!}
                <td class="border px-4 py-2">
                    <button
                        class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow"
                    >
                        削除
                    </button>
                </td>
                {!! Form::close() !!}
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
