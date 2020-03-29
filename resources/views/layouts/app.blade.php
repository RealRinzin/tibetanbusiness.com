<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- fontawesome -->
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/adminlte.min.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <div class="wrapper">
            <!-- Navbar -->
            <nav id="navbar" class="navbar navbar-expand navbar-light">
                <div class="container">
                    <a href="index3.html" class="navbar-brand">
                        <img src="img/AdminLTELogo.png" alt="AdminLTE Logo" class="img-circle elevation-3" style="opacity: .8;height:30px;width:30px">
                    </a>
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="index3.html" class="nav-link">Add Business</a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="#" class="nav-link">Promote Business</a>
                        </li>
                    </ul>

                    <!-- SEARCH FORM -->
                    <form class="form-inline ml-3">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Right navbar links -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="#" class="nav-link">Login </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- /.navbar -->
            <!-- content -->
            @yield('content')
            <footer>
                <div class="container">
                    <div class="row py-2">
                        <div class="col-md-12">
                            <img src="img/tibetanbusiness.png" alt="Tibetanbusiness logo" class="img-responsive d-flex justify-content-center">
                        </div>
                    </div>
                    <div class=" divider"></div>
                    <div class="row py-2">
                        <div class="col-md-12">
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="divider"></div>
                        <div class="col-md-2 col-sm-4 col-xs-4">
                            <ul>
                                <li>Miao</li>
                                <li>Tezu</li>
                                <li>Kollegal</li>
                                <li>Bylakuppe</li>
                                <li>Herbertpur</li>
                                <li>Mungod</li>
                            </ul>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-4">
                            <ul>
                                <li>Ravangala</li>
                                <li>Bandara</li>
                                <li>Mainpat</li>
                                <li>Odisha</li>
                                <li>Hunsur</li>
                                <li>Ladak</li>
                            </ul>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-4">
                            <ul>
                                <li>Tuting</li>
                                <li>Bir</li>
                                <li>Dalhousie</li>
                                <li>Kamrao</li>
                                <li>Kham karto</li>
                                <li>Ponta</li>
                            </ul>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-4">
                            <ul>
                                <li>Puruwala</li>
                                <li>Shimla</li>
                                <li>Bomdila</li>
                                <li>Dharamsala</li>
                                <li>Darjeeling</li>
                                <li>Clement Town</li>
                            </ul>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-4">
                            <ul>
                                <li>Gangtok</li>
                                <li>Kalimpong</li>
                                <li>Munduwala</li>
                                <li>Manali</li>
                                <li>Delhi</li>
                                <li>Shilong</li>
                            </ul>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-4">
                            <ul>
                                <li>Dekyiling</li>
                            </ul>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row py-1">
                        <p class="copyright text-center">© Copyright 2017</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>