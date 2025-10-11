<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate - お問い合わせ</title>
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
</head>
<body>
<header class="header">
  <a href="/" class="header__logo">FashionablyLate</a>
</header>

<main class="contact">
  <h2 class="contact__title">Contact</h2>

  <form action="{{ route('contact.confirm') }}" method="POST">
    @csrf

    {{-- お名前 --}}
    <div class="form__group">
      <label>お名前<span class="required">※</span></label>
      <input type="text" name="last_name" placeholder="例：山田" value="{{ old('last_name') }}">
      <input type="text" name="first_name" placeholder="例：太郎" value="{{ old('first_name') }}">
      @error('last_name') <p class="error">{{ $message }}</p> @enderror
      @error('first_name') <p class="error">{{ $message }}</p> @enderror
    </div>

    {{-- 性別 --}}
    <div class="form__group">
      <label>性別<span class="required">※</span></label>
      <label><input type="radio" name="gender" value="男性" {{ old('gender')=='男性'?'checked':'' }}> 男性</label>
      <label><input type="radio" name="gender" value="女性" {{ old('gender')=='女性'?'checked':'' }}> 女性</label>
      <label><input type="radio" name="gender" value="その他" {{ old('gender')=='その他'?'checked':'' }}> その他</label>
      @error('gender') <p class="error">{{ $message }}</p> @enderror
    </div>

    {{-- メール --}}
    <div class="form__group">
      <label>メールアドレス<span class="required">※</span></label>
      <input type="email" name="email" value="{{ old('email') }}" placeholder="例：test@example.com">
      @error('email') <p class="error">{{ $message }}</p> @enderror
    </div>

    {{-- 電話番号 --}}
    <div class="form__group">
      <label>電話番号<span class="required">※</span></label>
      <input type="text" name="tel1" value="{{ old('tel1') }}" maxlength="4"> -
      <input type="text" name="tel2" value="{{ old('tel2') }}" maxlength="4"> -
      <input type="text" name="tel3" value="{{ old('tel3') }}" maxlength="4">
      @error('tel1') <p class="error">{{ $message }}</p> @enderror
    </div>

    {{-- 住所 --}}
    <div class="form__group">
      <label>住所<span class="required">※</span></label>
      <input type="text" name="address" value="{{ old('address') }}" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3">
      @error('address') <p class="error">{{ $message }}</p> @enderror
    </div>

    {{-- 建物名 --}}
    <div class="form__group">
      <label>建物名</label>
      <input type="text" name="building" value="{{ old('building') }}" placeholder="例：千駄ヶ谷マンション101">
    </div>

    {{-- 種類 --}}
    <div class="form__group">
      <label>お問い合わせの種類<span class="required">※</span></label>
      <select name="category_id">
        <option value="">選択してください</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ old('category_id')==$category->id?'selected':'' }}>
            {{ $category->content }}
          </option>
        @endforeach
      </select>
      @error('category_id') <p class="error">{{ $message }}</p> @enderror
    </div>

    {{-- 内容 --}}
    <div class="form__group">
      <label>お問い合わせ内容<span class="required">※</span></label>
      <textarea name="content" rows="5" placeholder="お問い合わせ内容をご記載ください">{{ old('content') }}</textarea>
      @error('content') <p class="error">{{ $message }}</p> @enderror
    </div>

    <button type="submit" class="btn">確認画面へ</button>
  </form>
</main>
</body>
</html>
