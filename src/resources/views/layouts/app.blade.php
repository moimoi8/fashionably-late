<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashionably Late</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                Fashionably Late
            </a>

            <nav class="header__nav">
                @if(!Route::is('contact.index') &&!Route::is('contact.confirm'))
                @auth
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-button">logout</button>
                </form>
                @endauth

                @guest
                @if(Route::is('login'))
                <a href="{{ route('register') }}" class="register-link">register</a>
                @else
                <a href="{{ route('login') }}" class="login-link">login</a>
                @endif
                @endguest
                @endif
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

</body>

</html>