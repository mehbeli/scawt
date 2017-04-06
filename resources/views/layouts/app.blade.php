<!--
  _                         _                          _        ___
 | |                       | |                        | |      |__ \
 | |_ ___ _ __   __ _  ___ | | __   __ _ _ __   __ _  | |_ _   _  ) |
 | __/ _ \ '_ \ / _` |/ _ \| |/ /  / _` | '_ \ / _` | | __| | | |/ /
 | ||  __/ | | | (_| | (_) |   <  | (_| | |_) | (_| | | |_| |_| |_|
  \__\___|_| |_|\__, |\___/|_|\_\  \__,_| .__/ \__,_|  \__|\__,_(_)
                 __/ |                  | |
                |___/                   |_|
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/scawt.css" rel="stylesheet">
    <link rel="stylesheet" href="/packages/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.datatables/1.10.10/css/dataTables.bootstrap.min.css" integrity="sha256-z84A8SU1XXNN76l7Y+r65zvMYxgGD4v5wqg90I24Prw=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert/1.1.3/sweetalert.css" integrity="sha256-k66BSDvi6XBdtM2RH6QQvCz2wk81XcWsiZ3kn6uFTmM=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/selectize/0.12.4/css/selectize.css" integrity="sha256-HzWsbetzuScwBVnRYZIRJeXPQjHvyAMWhukery/8L8A=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/selectize/0.12.4/css/selectize.bootstrap3.css" integrity="sha256-vd+Uk9B3nkMoM/WcbPM7JmjXiD5aRvgUhRnKQJVp/hM=" crossorigin="anonymous">
    @yield('css')

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="/images/scawt.png" class="logo" alt="SCAWT">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    @if (Route::current()->uri != 'login' && Route::current()->uri != 'register' && Route::current()->uri != 'password/reset')
                    <ul class="nav navbar-nav">
                        <li><a href="/reports/create" class="report-a-scam"><i class="fa fa-fw fa-bullhorn fa-lg"></i> Report A Scam</a></li>
                    </ul>
                    @endif
                    @if (!Auth::guest())
                    <form class="navbar-form navbar-nav nav">
                        <input type="text" class="form-control" placeholder="Search...">
                    </form>
                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (!Auth::guest())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-fw fa-user-circle fa-lg"></i> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu dropdown-right dropdown-usermenu" role="menu">
                                    <li>
                                        <a href="#">Profile</a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                        <li><a href="/login">Login</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
        <div class="footer">
            <div><b>SCAWT 2017</b></div>
        </div>
    </div>

    <!-- Scripts
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="/js/app.js"></script> -->
    <script src="https://cdn.jsdelivr.net/jquery/3.2.1/jquery.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha256-U5ZEeKfGNOja007MMD3YBI0A3OSZOQbeG6z2f2Y0hu8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.datatables/1.10.10/js/jquery.dataTables.min.js" integrity="sha256-YKbJo9/cZwgjue3I4jsFKdE+oGkrSpqZz6voxlmn2Fo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.datatables/1.10.10/js/dataTables.bootstrap.min.js" integrity="sha256-+ytILf8MOU++C1U85FBAcI/KWqMfbbAdK7o1QN7bsOc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/sweetalert/1.1.3/sweetalert.min.js" integrity="sha256-egVvxkq6UBCQyKzRBrDHu8miZ5FOaVrjSqQqauKglKc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/selectize/0.12.4/js/standalone/selectize.min.js" integrity="sha256-HyBiZFJAMvxOhZoWOc5LWIWaN1gcFi8LjS75BZF4afg=" crossorigin="anonymous"></script>
    @yield('js')
</body>
</html>
