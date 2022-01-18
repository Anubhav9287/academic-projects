<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'IHM') }}</title>

    @stack('head')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer>
    </script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- chat dependency -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        h1,
        h2,
        h3 {
            padding: 0 0 5px 0;
            margin: 0;
        }

        #me .me {
            border-bottom: 1px solid #bbb3b3;
            padding: 10px 0;
            margin: 5px 0 15px 0;
        }

        #me .me img {
            width: 40px;
            border-radius: 50%;
            float: left;
            padding-right: 10px;
        }

        .user-list {
            width: 145px;
            border-right: 0px solid #8a7e7e;
            float: left;
        }

        .user-list ul {
            padding: 0;
            margin: 0;
        }

        .user-list ul li {
            padding: 5px 0;
            cursor: pointer;
            color: blue;
            list-style-type: none;
            padding: 10px 0;
        }

        .chat-window {
            width: 250px;
            height: 350px;
            border: 20px solid #ccc;
            border-color:lightblue;
            display: inline-block;
            padding: 5px;
            position:sticky;
            bottom: 5;
            right: 5;
        }

        .chat-window .head {
            height: 20px;
            padding: 5px;
            background:lightcoral;
            margin-bottom: 10px;
        }

        .chat-window .body {
            height: calc(100% - 20px)
        }

        .chat-window .body .chat-text {
            margin-bottom: 10px;
        }

        .chat-window .body .chat-text.me {
            text-align: right;
        }

        .chat-window .body .chat-text.me .userPhoto {
            float: right;
        }

        .chat-window .body .chat-text .userPhoto {
            width: 30px;
            float: left;
            border-radius: 50%;
            overflow: hidden;
            position: relative;
        }

        .chat-window .body .chat-text .userPhoto img {
            max-width: 100%;
        }

        .chat-window .footer {
            position: absolute;
            bottom: 5px;
            width: calc(100% - 10px);
        }

        .chat-window .footer button {
            width: 60px;
            height: 25px;
            color: lightseagreen;
        }

        .chat-window .footer input {
            width: calc(100% - 70px);
            height: 20px;
        }
    </style>
</head>

<body>
    
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <div> IHM Systems </div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @stack('script')
</body>
    

</html>