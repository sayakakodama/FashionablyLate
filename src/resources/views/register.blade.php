<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">
        FashionablyLate
      </a>
      <a class="header__login-button" href="/login">login
      </a>
    </div>
  </header>

  <main>
    <div class="fashionablylate__content">
      <div class="fashionablylate__heading">
        <h2>Register</h2>
      </div>
      <form class="form" action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">お名前
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="name" placeholder="例：山田 太郎" value="{{ old('name') }}" />
            </div>
            <div class="form__error">
                @error('name')
                {{ $message}}
                @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">メールアドレス</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="email" name="email" placeholder="例:test@example.com" value="{{ old('email') }}"/>
            </div>
            <div class="form__error">
              @error('email')
                {{ $message}}
                @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">パスワード</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="password" name="password" placeholder="例:coachtech1106" value="{{ old('password') }}"/>
            </div>
               @error('password')
                {{ $message}}
                @enderror
          </div>
        </div>
        <div class="form__button">
          <button class="form__button-submit" type="submit">登録</button>
        </div>
      </form>
    </div>
  </main> 
</body>
</html>
