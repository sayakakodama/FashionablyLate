<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>

<body>
  <header class="header">
  <a href="/" class="header__logo">FashionablyLate</a>
  <a href="/register" class="header__login-button">register</a>
</header>
<main>
  <div class="fashionablylate__content">
    <div class="fashionablylate__box">
      <h2 class="fashionablylate__heading">Login</h2>
      <form class="form" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form__group">
          <label class="form__group-title">メールアドレス</label>
          <div class="form__input--text">
            <input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}" />
          </div>
          @error('email')
            <div class="form__error">{{ $message }}</div>
          @enderror
        </div>
        <div class="form__group">
          <label class="form__group-title">パスワード</label>
          <div class="form__input--text">
            <input type="password" name="password" placeholder="例：coachtech1106" />
          </div>
          @error('password')
            <div class="form__error">{{ $message }}</div>
          @enderror
        </div>
        <div class="form__button">
          <button class="form__button-submit" type="submit">ログイン</button>
        </div>
      </form>
    </div>
  </div>
</main>
