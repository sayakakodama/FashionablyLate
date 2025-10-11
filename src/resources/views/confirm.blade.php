<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}" />
</head>
<body>
  <header class="header">
    <a href="/" class="header__logo">FashionablyLate</a>
  </header>

  <main class="contact">
    <h2 class="contact__title">Contact</h2>
    <form action="{{ route('contact.confirm') }}" method="POST">
      @csrf
      <div class="form__group">
        <label class="form__label">お名前<span class="form__required">※</span></label>
        <div class="form__input--name">
          <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例：山田" class="form__input">
          <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例：太郎" class="form__input">
        </div>
        @error('last_name') <p class="form__error">{{ $message }}</p> @enderror
        @error('first_name') <p class="form__error">{{ $message }}</p> @enderror
      </div>
      <div class="form__group">
        <label class="form__label">性別<span class="form__required">※</span></label>
        <div class="form__radio">
          <label><input type="radio" name="gender" value="男性" {{ old('gender') == '男性' ? 'checked' : '' }}> 男性</label>
          <label><input type="radio" name="gender" value="女性" {{ old('gender') == '女性' ? 'checked' : '' }}> 女性</label>
          <label><input type="radio" name="gender" value="その他" {{ old('gender') == 'その他' ? 'checked' : '' }}> その他</label>
        </div>
        @error('gender') <p class="form__error">{{ $message }}</p> @enderror
      </div>
      <div class="form__group">
        <label class="form__label">メールアドレス<span class="form__required">※</span></label>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="例：test@example.com" class="form__input--long">
        @error('email') <p class="form__error">{{ $message }}</p> @enderror
      </div>
      <div class="form__group">
        <label class="form__label">電話番号<span class="form__required">※</span></label>
        <div class="form__tel">
          <input type="text" name="tel1" maxlength="4" value="{{ old('tel1') }}" class="form__input--tel"> -
          <input type="text" name="tel2" maxlength="4" value="{{ old('tel2') }}" class="form__input--tel"> -
          <input type="text" name="tel3" maxlength="4" value="{{ old('tel3') }}" class="form__input--tel">
        </div>
        @error('tel1') <p class="form__error">{{ $message }}</p> @enderror
      </div>
      <div class="form__group">
        <label class="form__label">住所<span class="form__required">※</span></label>
        <input type="text" name="address" value="{{ old('address') }}" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" class="form__input--long">
        @error('address') <p class="form__error">{{ $message }}</p> @enderror
      </div>
      <div class="form__group">
        <label class="form__label">建物名</label>
        <input type="text" name="building" value="{{ old('building') }}" placeholder="例：千駄ヶ谷マンション101" class="form__input--long">
      </div>
      <div class="form__group">
        <label class="form__label">お問い合わせの種類<span class="form__required">※</span></label>
        <select name="category_id" class="form__select">
          <option value="">選択してください</option>
          <option value="1" {{ old('category_id') == 1 ? 'selected' : '' }}>商品の配送について</option>
          <option value="2" {{ old('category_id') == 2 ? 'selected' : '' }}>商品の交換について</option>
          <option value="3" {{ old('category_id') == 3 ? 'selected' : '' }}>商品トラブル</option>
          <option value="4" {{ old('category_id') == 4 ? 'selected' : '' }}>ショップへのお問い合わせ</option>
          <option value="5" {{ old('category_id') == 5 ? 'selected' : '' }}>その他</option>
        </select>
        @error('category_id') <p class="form__error">{{ $message }}</p> @enderror
      </div>
      <div class="form__group">
        <label class="form__label">お問い合わせ内容<span class="form__required">※</span></label>
        <textarea name="content" rows="5" placeholder="お問い合わせ内容をご記載ください" class="form__textarea">{{ old('content') }}</textarea>
        @error('content') <p class="form__error">{{ $message }}</p> @enderror
      </div>
      <div class="form__button">
        <button type="submit" class="form__btn">確認画面</button>
      </div>
    </form>
  </main>
</body>
</html>
