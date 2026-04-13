@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm">
        <div class="card-header text-center h4 mb-0">ユーザーログイン画面</div>

        <div class="card-body">
          {{-- フラッシュメッセージ（失敗など） --}}
          @if (session('status'))
            <div class="alert alert-info">{{ session('status') }}</div>
          @endif

          <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- メールアドレス --}}
            <div class="mb-3">
              <label for="email" class="form-label">メールアドレス</label>
              <input id="email"
                     type="email"
                     name="email"
                     value="{{ old('email') }}"
                     required
                     autocomplete="email"
                     autofocus
                     class="form-control @error('email') is-invalid @enderror"
                     placeholder="example@example.com">
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- パスワード --}}
            <div class="mb-4">
              <label for="password" class="form-label">パスワード</label>
              <input id="password"
                     type="password"
                     name="password"
                     required
                     autocomplete="current-password"
                     class="form-control @error('password') is-invalid @enderror"
                     placeholder="••••••••">
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- ボタン行：左が新規登録、右がログイン --}}
            <div class="d-flex gap-3 justify-content-center">
              <a href="{{ route('register') }}" class="btn btn-warning px-4">新規登録</a>
              <button type="submit" class="btn btn-info text-white px-5">ログイン</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
