@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">会員登録</div>
          <div class="panel-body">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form action="{{ route('register') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" />
              </div>
              <div class="form-group">
                <label for="name">ユーザー名</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" />
              </div>
              <div class="form-group">
                <input id="gender-m" type="radio" name="gender" value="male">
                <label for="gender-m">男性</label>
                <input id="gender-f" type="radio" name="gender" value="female">
                <label for="gender-f">女性</label>
              </div>
              <div class="form-group">
                <label for="password">年齢</label>
                <div class="">
                    <input id="age" type="number" min="1" class="form-control" name="age" value="{{ old('age') }}" >
                </div>
              </div>
              <div class="form-group">
                <label for="position">役職</label>
                <div class="">
                    <input id="position" type="position" min="0" class="form-control" name="position" value="{{ old('positon') }}" >
                </div>
              </div>
              <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
              <div class="form-group">
                <label for="password-confirm">パスワード（確認）</label>
                <input type="password" class="form-control" id="password-confirm" name="password_confirmation">
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">送信</button>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection
