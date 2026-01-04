<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link href="{{ asset('css/pagination.css') }}" rel="stylesheet">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                FashionablyLate
            </a>
            @if(Auth::check())
            <form class="form" action="/logout" method="post">
                @csrf
                <button class="header-nav__button">logout</button>
            </form>
            @endif
        </div>
    </header>
    <main>
        <div class="form__title">
            <h2>Admin</h2>
        </div>
        <form class="search__form" action="/search" method="get">
            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください"
                class="keyword">
            <div class="delta-icon__gender">
                <select name="gender">
                    <option value="">性別</option>
                    <option value="1" {{ request('gender') == 1  }}>男性</option>
                    <option value="2" {{ request('gender') == 2   }}>女性</option>
                    <option value="3" {{ request('gender') == 3  }}>その他</option>
                </select>
            </div>
            <div class="delta-icon__category_id">
                <select name="category_id">
                    <option value="">お問い合わせの種類</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->content }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="delta-icon__date">
                <input type="date" name="date" value="{{ request('date') }}">
            </div>

            <button type="submit" class="search-form__button">検索</button>
            <div class="search-form__reset">
                <a href="/reset">リセット</a>
            </div>
        </form>
        <div class="export__paginate">
            <div class="export">
                <a href="/export?keyword={{ request('keyword') }}
&gender={{ request('gender') }}
&category_id={{ request('category_id') }}
&date={{ request('date') }}">
                    エクスポート
                </a>
            </div>
            <div class="paginate">
                {{ $contacts->links('pagination::bootstrap-4') }}
            </div>
        </div>
        <table class="main-content">
            <tr class="content__title">
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
            @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->first_name }} {{ $contact->last_name }}
                </td>
                <td>{{ $genderMap[$contact->gender] }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->category->content }}</td>
                <td class="detail-button">
                    <button type="button" class="detail" data-bs-toggle="modal"
                        data-bs-target="#modal-{{ $contact->id }}">
                        詳細
                    </button>

                    <div class="modal fade" id="modal-{{ $contact->id }}" data-bs-backdrop="static" tabindex="-1">

                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <table class="modal__content">
                                        <tr class="modal-inner">
                                            <th class="modal-ttl">お名前</th>
                                            <td class="modal-data">
                                                {{ $contact['first_name'] }}
                                                <span class="space"></span>
                                                <span class="firstName">{{ $contact['last_name'] }}</span>
                                            </td>
                                        </tr>
                                        <tr class="modal-inner">
                                            <th class="modal-ttl">性別</th>
                                            <td class="modal-data">
                                                <input type="hidden" value="{{ $contact['gender'] }}" />
                                                <?php
                                        if ($contact['gender'] == '1') {
                                            echo '男性';
                                        } elseif ($contact['gender'] == '2') {
                                            echo '女性';
                                        } else {
                                            echo 'その他';
                                        }
                                        ?>
                                            </td>
                                        </tr>
                                        <tr class="modal-inner">
                                            <th class="modal-ttl">メールアドレス</th>
                                            <td class="modal-data">{{ $contact['email'] }}</td>
                                        </tr>
                                        <tr class="modal-inner">
                                            <th class="modal-ttl">電話番号</th>
                                            <td class="modal-data">{{ $contact['tel'] }}</td>
                                        </tr>
                                        <tr class="modal-inner">
                                            <th class="modal-ttl">住所</th>
                                            <td class="modal-data">{{ $contact['address'] }}</td>
                                        </tr>
                                        <tr class="modal-inner">
                                            <th class="modal-ttl">建物名</th>
                                            <td class="modal-data">{{ $contact['building'] }}</td>
                                        </tr>
                                        <tr class="modal-inner">
                                            <th class="modal-ttl">お問い合わせの種類</th>
                                            <td class="modal-data">{{ $contact['category']['content'] }}</td>
                                        </tr>
                                        <tr class="modal-inner">
                                            <th class="modal-ttl--last">お問い合わせ内容</th>
                                            <td class="modal-data--last">
                                                {{ $contact['detail']}}
                                            </td>
                                        </tr>
                                    </table>
                                    <form class="delete-form" action="/delete" method="post">
                                        @method('delete')
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $contact['id'] }}" />
                                        <button class="delete-btn">削除</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>