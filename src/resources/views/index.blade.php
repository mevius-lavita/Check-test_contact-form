<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
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
                <h2>Contact</h2>
            </div>
            <form class="form" action="/confirm" method="post">
                @csrf
                <table class="contact_table">
                    <tr>
                        <th>お名前
                            <span class="form__label--required">※</span>
                        </th>
                        <td>
                            <input type="text" id="name" name="first_name" placeholder="例：山田">
                            <input type="text" id="name" name="last_name" placeholder="例：太郎">
                        </td>
                    </tr>
                    @error('first_name')
                    <tr>
                        <td><span style="color: red; font-size:10px">
                                {{$errors->first('first_name')}}</span></td>
                    </tr>
                    @enderror
                    @error('last_name')
                    <tr>
                        <td><span style="color: red; font-size:10px">
                                {{$errors->first('last_name')}}</span></td>
                    </tr>
                    @enderror
                    <tr>
                        <th>性別
                            <span class="form__label--required">※</span>
                        </th>
                        <td>
                            <input type="radio" id="gender" name="gender" value="1">
                            <label>男性</label>
                            <input type="radio" id="gender" name="gender" value="2">
                            <label>女性</label>
                            <input type="radio" id="gender" name="gender" value="3">
                            <label>その他</label></td>
                        </td>
                    </tr>
                    @error('gender')
                    <tr>
                        <td><span style="color: red; font-size:10px">
                                {{$errors->first('gender')}}</span></td>
                    </tr>
                    @enderror
                    <tr>
                        <th>
                            メールアドレス
                            <span class="form__label--required">※</span>
                        </th>
                        <td><input type="text" id="email" name="email" placeholder="例：test@example.com"></td>
                    </tr>
                    @error('email')
                    <tr>
                        <td><span style="color: red; font-size:10px">
                                {{$errors->first('email')}}</span></td>
                    </tr>
                    @enderror
                    <tr>
                        <th>
                            電話番号<span class="form__label--required">※</span>
                        </th>
                        <td>
                            <input type="tel" id="tel" name="tel1" maxlength="5" placeholder="080" pattern="\d*" />
                            <span class="tel__icon">-</span>
                            <input type="tel" id="tel" name="tel2" maxlength="5" placeholder="1234" pattern="\d*" />
                            <span class="tel__icon">-</span>
                            <input type="tel" id="tel" name="tel3" maxlength="5" placeholder="5678" pattern="\d*" />
                        </td>
                    </tr>
                    @if ($errors->has('tel1') || $errors->has('tel2') || $errors->has('tel3'))
                    <tr>
                        <td>
                            <span
                                style="color: red; font-size:10px">{{ $errors->first('tel1') ?? $errors->first('tel2') ?? $errors->first('tel3') }}</span>
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <th>住所
                            <span class="form__label--required">※</span>
                        </th>
                        <td>
                            <input type="text" id="address" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3">
                        </td>
                    </tr>
                    @error('address')
                    <tr>
                        <td><span style="color: red; font-size:10px">
                                {{$errors->first('address')}}</span></td>
                    </tr>
                    @enderror
                    <tr>
                        <th>
                            建物名
                        </th>
                        <td>
                            <input type="text" id="building" name="building" placeholder="例：千駄ヶ谷マンション101">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            お問い合わせの種類
                            <span class="form__label--required">※</span>
                        </th>
                        <td>
                            <div class="select__content">
                                <select name="category_id" class="category_id">
                                    <option value="">選択してください</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->content }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                    @error('category_id')
                    <tr>
                        <td><span style="color: red; font-size:10px">
                                {{$errors->first('category_id')}}</span></td>
                    </tr>
                    @enderror
                    <tr>
                        <th>お問い合わせ内容
                            <span class="form__label--required">※</span>
                        </th>
                        <td>
                            <textarea cols="80" rows="7" name="detail" class="contact__detail"
                                placeholder="お問い合わせ内容をご記載ください"></textarea>
                        </td>
                    </tr>
                    @error('detail')
                    <tr>
                        <td><span style="color: red; font-size:10px">
                                {{$errors->first('detail')}}</span></td>
                    </tr>
                    @enderror
                </table>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">確認画面</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>