<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @yield('stylesheet')
    <title>@yield('title')</title>
    @yield('style')
</head>
<body>
    <header>
        <div class="header_nav wrapper">
            @if (Route::has('login'))
            <div class="links">
                @auth
                <a href="{{ url('/') }}">Top <i class="fas fa-desktop"></i></a>
                <a href="{{ url('/mypage') }}">Mypage <i class="fas fa-fish"></i></a>
                <a href="{{ route('logout') }}">Logout <i class="fas fa-sign-out-alt"></i></a>
                @if(Auth::user()->notice_friends()->where('state',1)->count()>0 || Auth::user()->notice_posts()->where('state',1)->count()>0)
                <a href="{{route('notices')}}"><i class="fas fa-bell red-badge"><span class="badge"></span></i></a>
                @else
                <a href="{{route('notices')}}"><i class="fas fa-bell yellow-badge"></i></a>
                @endif
                @else
                <a href="{{ route('login') }}">Login <i class="fas fa-sign-in-alt"></i></a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}">Register <i class="far fa-star"></i></a>
                @endif
                @endauth
                
            </div>
            @endif
        </div>
    </header>
    @yield('content')
</body>

</html>