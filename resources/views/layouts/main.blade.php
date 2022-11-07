<!DOCTYPE>
<html>
<head>
    <title>PHP/LARAVEL COMPETENCY TEST - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <style>
        body, html {
            height: 100%;
        }

        #sidebar {
            min-width: 130px;
        }

        .nav-link[data-toggle].collapsed:after {
            content: "▾";
        }

        .nav-link[data-toggle]:not(.collapsed):after {
            content: "▴";
        }
    </style>
</head>
<body>
<div class="container-fluid h-100">
    <div class="row h-100">
        <div class="col-2 collapse d-md-flex bg-faded pt-2 h-100" id="sidebar">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Users</a></li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#submenu1" data-toggle="collapse" data-target="#submenu1">Payment
                        Methods</a>
                    <div class="collapse" id="submenu1" aria-expanded="false">
                        <ul class="flex-column pl-2 nav">
                            <li class="nav-item">
                                <a class="nav-link py-0" href="{{ route('payment-methods.idex') }}">Payment Methods</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-0" href="{{ route('payment-methods.create') }}">Add Payment
                                    Method</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col pt-2">
            <h2>
                <a href="" data-target="#sidebar" data-toggle="collapse" class="hidden-md-up"><i class="fa fa-bars"></i></a>
                @if (Route::has('login'))
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                               class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log
                                in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                   class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </h2>
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
