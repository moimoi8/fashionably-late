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
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                Fashionably Late
            </a>
        </div>
        <nav class="header_nav">
            @if(!Route::is('contact.index'))
            @auth
            <form method="post" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button">logout</button>
            </form>
            @endauth

            @guest
            @if(!Route::is('login'))
            <a href="{{ route('login') }}" class="login-link">login</a>
            @endif
            @endguest
            @endif
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

</body>

</html>