<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">FashionablyLate</a>
      <a class="header__login-button" href="/">logout</a>
    </div>
  </header>

  <main>
    <div class="fashionablylate__content">
      <div class="fashionablylate__heading">
        <h2>Admin</h2>
      </div>

      <form class="form search-form" action="{{ route('admin.contacts.search') }}" method="GET">
        <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">
        
        <select name="gender">
            <option value="">性別</option>
            <option value="1" @selected(request('gender') == 1)>男性</option>
            <option value="2" @selected(request('gender') == 2)>女性</option>
            <option value="3" @selected(request('gender') == 3)>その他</option>
        </select>

        <select name="category_id">
          <option value="">お問合せの種類</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
              {{ $category->content }}
            </option>
          @endforeach
        </select>

        <input type="date" name="date" value="{{ request('date') }}">

        <button type="submit" class="btn-search">検索</button>
        <a href="{{ route('admin.contacts.index') }}" class="btn-reset">リセット</a>
      </form>

      <div class="export">
        <a href="{{ route('admin.contacts.index', request()->query()) }}" class="btn-export">エクスポート</a>
      </div>

      <table class="contact-table">
        <thead>
          <tr>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @forelse($contacts as $contact)
          <tr>
            <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
            <td>
              @if($contact->gender == 1) 男性
              @elseif($contact->gender == 2) 女性
              @else その他
              @endif
            </td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->category->content }}</td>
            <td>
              <button class="btn-detail"
                      data-id="{{ $contact->id }}"
                      data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
                      data-gender="{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}"
                      data-email="{{ $contact->email }}"
                      data-phone="{{ $contact->tell }}"
                      data-address="{{ $contact->address }}"
                      data-building="{{ $contact->building }}"
                      data-category="{{ $contact->category->content }}"
                      data-content="{{ $contact->detail }}">
                詳細
              </button>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="no-data">データがありません</td>
          </tr>
          @endforelse
        </tbody>
      </table>

      <div class="pagination">
        {{ $contacts->links() }}
      </div>

    </div>
  </main>
  <div id="modal" class="modal hidden">
    <div class="modal-content">
      <span id="closeModal" class="close">&times;</span>
      <h2>FashionablyLate</h2>
      <div class="modal-body">
        <p><strong>お名前:</strong> <span id="modal-name"></span></p>
        <p><strong>性別:</strong> <span id="modal-gender"></span></p>
        <p><strong>メールアドレス:</strong> <span id="modal-email"></span></p>
        <p><strong>電話番号:</strong> <span id="modal-phone"></span></p>
        <p><strong>住所:</strong> <span id="modal-address"></span></p>
        <p><strong>建物名:</strong> <span id="modal-building"></span></p>
        <p><strong>お問い合わせの種類:</strong> <span id="modal-category"></span></p>
        <p><strong>お問い合わせ内容:</strong> <span id="modal-content"></span></p>
      </div>
      <form id="deleteForm" method="POST" action="">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete">削除</button>
      </form>
    </div>
  </div>

  <script>
  document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("modal");
    const closeModal = document.getElementById("closeModal");
    const deleteForm = document.getElementById("deleteForm");

    document.querySelectorAll(".btn-detail").forEach(button => {
      button.addEventListener("click", () => {
        document.getElementById("modal-name").textContent = button.dataset.name;
        document.getElementById("modal-gender").textContent = button.dataset.gender;
        document.getElementById("modal-email").textContent = button.dataset.email;
        document.getElementById("modal-phone").textContent = button.dataset.phone;
        document.getElementById("modal-address").textContent = button.dataset.address;
        document.getElementById("modal-building").textContent = button.dataset.building;
        document.getElementById("modal-category").textContent = button.dataset.category;
        document.getElementById("modal-content").textContent = button.dataset.content;
        deleteForm.action = `/admin/contacts/${button.dataset.id}`;
        modal.classList.remove("hidden");
      });
    });

    closeModal.addEventListener("click", () => {
      modal.classList.add("hidden");
    });

    modal.addEventListener("click", e => {
      if (e.target === modal) modal.classList.add("hidden");
    });
  });
  </script>

</body>
</html>
