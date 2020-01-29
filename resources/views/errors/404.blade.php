@extends('layout')
{{--
    エラー画面を作る、resources/views ディレクトリにさらに errors ディレクトリを作成する。
    この errors ディレクトリに レスポンスコード.blade.php という名前でテンプレートを作成すれば、abort 関数などでエラー系のレスポンスが作成されるときに
    対応するファイル名のテンプレートが画面として使われる。
--}}
@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <div class="text-center">
          <p>お探しのページにアクセスする権限がありません。</p>
          <a href="{{ route('home') }}" class="btn">
            ホームへ戻る
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection
