@extends('layout')

@section('content')
    <table border="1">
        <thead>
            <tr>
                <th colspan="2">全てのユーザー</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>編集</td>
            </tr>
        </tbody>
        <tfoot>
            @foreach ($allUser as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td><a href=" {{ route('users.edit', ['user' => $user->id])}}" class="btn btn-default btn-block">編集</a></td>
            </tr>
            @endforeach
        </tfoot>
    </table>
@endsection
