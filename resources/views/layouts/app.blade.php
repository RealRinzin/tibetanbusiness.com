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
                        @guest
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="#" class="nav-link" data-toggle="modal" data-target="#login">Login </a>
                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
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
                        <!-- <li class="nav-item d-none d-sm-inline-block">
                            <a href="#" class="nav-link" data-toggle="modal" data-target="#login">Login </a>
                        </li> -->
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
    <!-- login Modal -->
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header bg-danger">
                    <h5 class="modal-title text-center" id="exampleModalLabel" style="margin: 0px auto !important">Login with Tibetanbusiness.com</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div> -->
                <div class="modal-body">
                    <div class="container">
                        <!-- <div class="row">
                            <div class="col-md-6">
                                <a href="login/github" class="btn btn-block btn-primary">
                                    <i class="fab fa-facebook-square fa-lg"></i>
                                    <span>Sign in using Facebook</span>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="login/github" class="btn btn-block btn-danger">
                                    <i class="fab fa-github-square fa-lg"></i>
                                    <span>Sign in using Github</span>
                                </a>
                            </div>
                        </div> -->
                    </div>
                    <div class="card-body login-card-body text-center">
                        <img src="img/tibetanbusiness.png" alt="">
                        <h5 class="text-center my-3">Sign in with</h5>
                        <a href="#" class="btn btn-block btn-primary py-1">
                            <i class="fab fa-facebook fa-lg mr-2"></i> Sign in using Facebook
                        </a>
                        <a href="login/github" class="btn btn-block btn-secondary py-1 my-3">
                            <i class="fab fa-github-square fa-lg mr-3"></i>
                            <span>Sign in using Github</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>