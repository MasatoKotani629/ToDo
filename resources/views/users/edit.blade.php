@extends('layout')

@section('content')
    <form
    method="POST"
    action="{{ route('users.update', ['user' => $user->id]) }}"
    >
    {{-- <form
    action="{{ route('tasks.edit', ['folder' => $task->folder_id, 'task' => $task->id]) }}"
    method="POST"
    > --}}
    @csrf
    <table border="1">
        <thead>
            <tr>
                <th colspan="2">ユーザー情報</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Name</th>
                {{-- <th>email</th> --}}
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>
                    <input type="text" name="name" value="{{$user->name}}">
                </td>
                {{-- <td>
                    <input type="text" name="email" value="{{$user->email}}">
                </td> --}}
            </tr>
        </tfoot>
    </table>
    <button type="submit" class="btn btn-primary">送信</button>
    </form>
@endsection
