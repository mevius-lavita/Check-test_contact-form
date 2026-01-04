<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                FashionablyLate
            </a>
            <a href="/register" class="register__link">register</a>
            </form>
        </div>
    </header>
    <main>
        <div class="form__content">
            <div class="form__title">
                <h2>Login</h2>
            </div>
            <form class="form" action="/login" method="post">
                @csrf
                <p class="form__label">メールアドレス</p>
                @error('email')
                <p style="color: red; font-size:10px">
                    {{$errors->first('email')}}
                </p>
                @enderror
                <input type="email" name="email" value="{{ old('email') }}" placeholder="例：test@example.com">
                <p class="form__label">パスワード</p>
                @error('password')
                <p style="color: red; font-size:10px">
                    {{$errors->first('password')}}
                </p>
                @enderror
                <input type="password" name="password" placeholder="例：coachtech1006">
                <div class="form__button">
                    <button class="form__button-submit" type="submit">ログイン</button>
                </div>
            </form>
        </div>
</body>

</html>