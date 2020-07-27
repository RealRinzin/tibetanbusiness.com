<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="twitter:title">
    <meta name="description" />
    <meta itemprop="description">
    <meta property="og:description">
    <meta property="fb:app_id" content="123456789">
    <meta property="og:url" content="https://tibetanbusiness.com:8890">
    <meta property="og:type" content="website">
    <meta property="og:title" content="title">
    <meta property="og:image" content="image">
    <meta property="og:image:alt" content="description">
    <meta property="og:description" content="description">
    <meta property="og:site_name" content="https://tibetanushiness.com">
    <meta property="og:locale" content="en_US">
    <meta property="article:author" content="Rinzin">
    <!-- CSRF Token -->
    <title> @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" sizes="72x72" href="{{asset('tibetanbusiness.png')}}">
    <title>{{ config('app.name', 'Tibetanbusiness.com') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- JQUERY UI -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- fontawesome -->
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <!-- Adminlte -->
    <link href="{{ asset('css/adminlte.min.css') }}" rel="stylesheet">
    <!-- rating star -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <!-- google map -->
    <!-- jquery UI -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZUKCfCsYwHBgUalqcKyrdhmLTCsjBj2M&callback=myMap"></script>
</head>

<body>
    <div id="app">
        <div class="wrapper">
            <!-- Navbar -->
            <nav id="navbar" class="navbar navbar-expand navbar-light">
                <div class="container">
                    <a href="/" class="navbar-brand">
                        <img src="{{asset('img/tibetanbusiness.png')}}" alt="Tibetanbusiness.com logo" class="img-circle elevation-3" style="opacity: .8;height:30px;width:30px">
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
                        <div id="avatar">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{Auth::user()->avatar}}" alt="" class="img-fluid img-circle" style="height:35;width:35px">
                                    <!-- {{ Auth::user()->name }} <span class="caret"></span> -->
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <nav-bar></nav-bar>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </div>
                        @endguest
                        <!-- <li class="nav-item d-none d-sm-inline-block">
                            <a href="#" class="nav-link" data-toggle="modal" data-target="#login">Login </a>
                        </li> -->
                    </ul>
                </div>
            </nav>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container">
                    <a class="navbar-brand" href="#">Navbar</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Dropdown
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">Disabled</a>
                            </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" onkeyup="auto_complete()">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
            <!-- /.navbar -->
            <!-- content -->
            @yield('content')
            <footer>
                <div class="container">
                    <div class="row py-2">
                        <div class="col-md-12">
                            <img src="{{asset('img/tibetanbusiness.png')}}" alt="Tibetanbusiness logo" class="img-responsive d-flex justify-content-center">
                        </div>
                    </div>
                    <div class=" divider"></div>
                    <div class="row py-2">
                        <div class="col-md-12">
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="divider"></div>
                        <div class="col-md-2 col-sm-4 col-6">
                            <ul>
                                <li>Miao</li>
                                <li>Tezu</li>
                                <li>Kollegal</li>
                                <li>Bylakuppe</li>
                                <li>Herbertpur</li>
                                <li>Mungod</li>
                            </ul>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6 my-1">
                            <ul>
                                <li>Ravangala</li>
                                <li>Bandara</li>
                                <li>Mainpat</li>
                                <li>Odisha</li>
                                <li>Hunsur</li>
                                <li>Ladak</li>
                            </ul>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6 my-1">
                            <ul>
                                <li>Tuting</li>
                                <li>Bir</li>
                                <li>Dalhousie</li>
                                <li>Kamrao</li>
                                <li>Kham karto</li>
                                <li>Ponta</li>
                            </ul>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6 my-1">
                            <ul>
                                <li>Puruwala</li>
                                <li>Shimla</li>
                                <li>Bomdila</li>
                                <li>Dharamsala</li>
                                <li>Darjeeling</li>
                                <li>Clement Town</li>
                            </ul>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6 my-1">
                            <ul>
                                <li>Gangtok</li>
                                <li>Kalimpong</li>
                                <li>Munduwala</li>
                                <li>Manali</li>
                                <li>Delhi</li>
                                <li>Shilong</li>
                            </ul>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6 my-1">
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
                    <div class="card">
                        <div class="card-body login-card-body">
                            <p class="login-box-msg">Sign in to start your session</p>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" placeholder="Email">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" placeholder="Password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="icheck-primary">
                                            <input type="checkbox" id="remember">
                                            <label for="remember">
                                                Remember Me
                                            </label>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>

                            <div class="social-auth-links text-center mb-3">
                                <p>- OR -</p>
                                <a href="{{url('login/facebook')}}" class="btn btn-block btn-primary">
                                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                                </a>

                                <a href="{{ url('login/google') }}" class="btn btn-block btn-danger">
                                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                                </a>
                                <a href="{{url('login/github')}}" class="btn btn-block btn-secondary">
                                    <i class="fab fa-github mr-2"></i> Sign in using Github
                                </a>
                            </div>
                            <!-- /.social-auth-links -->

                            <p class="mb-1">
                                <a href="forgot-password.html">I forgot my password</a>
                            </p>
                            <p class="mb-0">
                                <a href="register.html" class="text-center">Register a new membership</a>
                            </p>
                        </div>
                        <!-- /.login-card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- jquery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Auto Complete -->
    <script>
        $("li").click(function() {
            let term = $(this).attr("value")
            $("#service_search").val(term);
            // Closing the dropdown
            $("#dropdown").css("display", "none");
        });
    </script>
</body>

</html>