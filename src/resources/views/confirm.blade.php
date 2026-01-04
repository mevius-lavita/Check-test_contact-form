<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Confirm Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                FashionablyLate
            </a>
        </div>
    </header>
    <main>
        <div class="form__content">
            <div class="form__title">
                <h2>Confirm</h2>
            </div>
            <form class="form" action="/thanks" method="POST">
                @csrf
                <table>
                    <tr>
                        <th>お名前</th>
                        <td class="name">
                            <input type="text" value="{{ $contact['first_name'] }}{{ $contact['last_name'] }}">
                            <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                            <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                        </td>
                    </tr>
                    <tr>
                        <th>性別</th>
                        <td>
                            <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                            <input type="text" value="{{ $displayGender }}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td>
                            <input type="text" name="email" value="{{ $contact['email'] }}" />
                        </td>
                    </tr>
                    <tr>
                        <th>電話番号</th>
                        <td>
                            <input type="hidden" name="tel" value="{{ $contact['tel'] }}">
                            <input type="text" value="{{ $contact['tel'] }}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>住所</th>
                        <td>
                            <input type="text" name="address" value="{{ $contact['address'] }}" />
                        </td>
                    </tr>
                    <tr>
                        <th>建物名</th>
                        <td>
                            <input type="text" name="building" value="{{ $contact['building'] }}" />
                        </td>
                    </tr>
                    <tr>
                        <th>お問い合わせの種類</th>
                        <td>
                            <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                            <input type="text" value="{{ $category->content }}" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>お問い合わせ内容</th>
                        <td>
                            <input type="text" name="detail" value="{{ $contact['detail'] }}" />
                        </td>
                    </tr>
                </table>
                <div class="contact-form__button-submit">
                    <button class="contact-form__button-submit__post" type="submit">送信</button>
                    <a onclick="history.back()" class="contact-form__button-submit__reset">修正</a>
                </div>
            </form>
        </div>
    </main>

</body>

</html>