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
                <li class="nav-item"><a class="nav-link" href="#">Overview</a></li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#submenu1" data-toggle="collapse" data-target="#submenu1">Reports</a>
                    <div class="collapse" id="submenu1" aria-expanded="false">
                        <ul class="flex-column pl-2 nav">
                            <li class="nav-item">
                                <a class="nav-link py-0" href="">Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link collapsed py-0" href="#submenu1sub1" data-toggle="collapse"
                                   data-target="#submenu1sub1">Customers</a>
                                <div class="collapse small" id="submenu1sub1" aria-expanded="false">
                                    <ul class="flex-column nav pl-4">
                                        <li class="nav-item">
                                            <a class="nav-link p-0" href="">
                                                <i class="fa fa-fw fa-clock-o"></i> Daily
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link p-0" href="">
                                                <i class="fa fa-fw fa-dashboard"></i> Dashboard
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link p-0" href="">
                                                <i class="fa fa-fw fa-bar-chart"></i> Charts
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link p-0" href="">
                                                <i class="fa fa-fw fa-compass"></i> Areas
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="#">Analytics</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Export</a></li>
            </ul>
        </div>
        <div class="col pt-2">
            <h2>
                <a href="" data-target="#sidebar" data-toggle="collapse" class="hidden-md-up"><i class="fa fa-bars"></i></a>
                Content
            </h2>
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
