<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Tibetanbusiness.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Description" content="Put your description here.">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" sizes="72x72" href="{{asset('/img/tibetanbusiness.png')}}">
    <!-- <title>{{ config('app.name', 'Tibetanbusiness.com') }}</title> -->
    <!-- META -->
    <meta property="og:title" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta property="og:description" content="" />
    <!-- META END -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- @if(Request::is('/')) -->
    <!-- @endif -->
    @if(!Request::is('/'))
    <link href="{{ asset('css/jquery.ui.min.css') }}" rel="stylesheet">
    @endif
    <!-- JQUERY UI -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- fontawesome -->
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <!-- Adminlte -->
    <!-- <link href=" {{ asset('css/adminlte.min.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Loading -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/placeholder-loading/dist/css/placeholder-loading.min.css">
    <!-- Mapbox -->
    <link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' />
    <script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.0.1/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.0.1/mapbox-gl.css" rel="stylesheet" />
    <!-- CSRF TOKEN -->
    <script>
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>
    </script>
</head>

<body>
    @if(Request::is('/'))
    <div id="tibetanbusiness">
        @endif
        @if(!Request::is('/'))
        <div id="tibetanbusiness-details">
            @endif
            <div class="wrapper">
                <!-- Navbar -->
                @if(Request::is('/'))
                <nav id="navbar" class="navbar navbar-expand navbar-light position-fixed w-100 p-1">
                    <div class="container">
                        <a href="/" class="navbar-brand">
                            <img src="{{asset('img/tibetanbusiness.png')}}" alt="Tibetanbusiness.com logo" class="elevation-3" style="opacity:.8;height:35px;width:35px">
                        </a>
                        <!-- SEARCH FORM -->
                        @if(Request::is('/'))
                        <!-- Left navbar links -->
                        <ul class="navbar-nav">
                            @guest
                            <li class="nav-item d-sm-inline-block">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#login">Add Business</a>
                            </li>
                            @else
                            <li class="nav-item d-sm-inline-block">
                                <a href="/dashboard/event" class="nav-link">Add Business</a>
                            </li>
                            @endguest
                            <!-- <li class="nav-item d-sm-inline-block">
                                <a href="#" class="nav-link">Promote Business</a>
                            </li> -->
                        </ul>
                        @else
                        <ul class="navbar-nav d-none d-sm-block">
                            <!-- <ul class="navbar-nav d-none d-sm-block" id="desktop_add_promote_link"> -->
                            <li class="nav-item d-sm-inline-block">
                                <a href="index3.html" class="nav-link">Add Business</a>
                            </li>
                            <li class="nav-item d-sm-inline-block">
                                <a href="#" class="nav-link">Promote Business</a>
                            </li>
                        </ul>
                        <div class="row mx-auto">
                            <div class="col-md-12">
                                <div id="dropdown_lists">
                                    <form class="form-inline ml-3" method="get" action="">
                                        {{ csrf_field() }}
                                        <nav-search></nav-search>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- Right navbar links -->
                        <ul class="navbar-nav ml-auto">
                            @guest
                            <li class="nav-item d-sm-inline-block">
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#login">Login </a>
                            </li>
                            @else
                            <div id="avatar">
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle p-1" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                                        <span><img src="{{Auth::user()->avatar}}" alt="" class="ml-2 img-fluid rounded-circle"></span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <!-- <nav-bar></nav-bar> -->
                                        <a class="dropdown-item" href="/dashboard/event">Dashboard</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                            <button id="clear_storage" type="submit" class="dropdown-item p-1">Logout</button>
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </div>
                            @endguest
                        </ul>
                    </div>
                </nav>
                @else
                <nav id="navbar" class=" navbar navbar-expand navbar-light" style="background-color: #941c18 !important">
                    <div class="container">
                        <div class="row w-100">
                            <div class="col-2">
                                <a href="/" class="navbar-brand">
                                    <img src="{{asset('img/tibetanbusiness.png')}}" alt="Tibetanbusiness.com logo" class="elevation-3" style="opacity: .8;height:30px;width:30px">
                                </a>
                            </div>
                            <div class="col-8">
                                <div class="row mx-auto">
                                    <nav-search></nav-search>
                                </div>
                            </div>
                            <div class="col-2">
                                <ul class="navbar-nav float-right">
                                    @guest
                                    <li class="nav-item d-sm-inline-block">
                                        <a href="#" class="nav-link" data-toggle="modal" data-target="#login">Login </a>
                                    </li>
                                    @else
                                    <div id="avatar" style="z-index: 1000;">
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                <img src="{{Auth::user()->avatar}}" alt="" class="img-fluid rounded-circle">
                                                <!-- {{ Auth::user()->name }} --> <span class="caret"></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                <!-- <nav-bar></nav-bar> -->
                                                <a class="dropdown-item" href="/dashboard/event">Dashboard</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                    <button id="clear_storage" type="submit" class="dropdown-item p-1">Logout</button>
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    </div>
                                    @endguest
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
                @endif
                @if(!Request::is('/'))
                <div class="alert alert-secondary alert-dismissible fade show m-1 rounded-0 text-center w-100 d-block d-sm-none" role="alert" id="mobile_add_promote_link">
                    @guest
                    <button class="btn btn-warning" data-toggle="modal" data-target="#login">Add Business</button>
                    @else
                    <a class="btn btn-warning" href="/dashboard/event">Add Business</a>
                    @endguest

                    <button class="btn btn-warning d-none">Promote Business</button>
                    <button type="button" class="close text-dark" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif
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
                        <div class="col-md-2 col-sm-4 col-4">
                            <ul>
                                <li>Miao</li>
                                <li>Tezu</li>
                                <li>Kollegal</li>
                                <li>Bylakuppe</li>
                                <li>Herbertpur</li>
                                <li>Mungod</li>
                            </ul>
                        </div>
                        <div class="col-md-2 col-sm-4 col-4 my-1">
                            <ul>
                                <li>Ravangala</li>
                                <li>Bandara</li>
                                <li>Mainpat</li>
                                <li>Odisha</li>
                                <li>Hunsur</li>
                                <li>Ladak</li>
                            </ul>
                        </div>
                        <div class="col-md-2 col-sm-4 col-4 my-1">
                            <ul>
                                <li>Tuting</li>
                                <li>Bir</li>
                                <li>Dalhousie</li>
                                <li>Kamrao</li>
                                <li>Kham karto</li>
                                <li>Ponta</li>
                            </ul>
                        </div>
                        <div class="col-md-2 col-sm-4 col-4 my-1">
                            <ul>
                                <li>Puruwala</li>
                                <li>Shimla</li>
                                <li>Bomdila</li>
                                <li>Dharamsala</li>
                                <li>Darjeeling</li>
                                <li>Clement Town</li>
                            </ul>
                        </div>
                        <div class="col-md-2 col-sm-4 col-4 my-1">
                            <ul>
                                <li>Gangtok</li>
                                <li>Kalimpong</li>
                                <li>Munduwala</li>
                                <li>Manali</li>
                                <li>Delhi</li>
                                <li>Shilong</li>
                            </ul>
                        </div>
                        <div class="col-md-2 col-sm-4 col-4 my-1">
                            <ul>
                                <li>Dekyiling</li>
                            </ul>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row py-1">
                        <div class="col-12">
                            <p class="copyright text-center">Tibetanbusiness © Copyright <?php echo date('Y'); ?></p>
                            <p class="copyright text-center">
                                <span><i class="fab fa-facebook fa-2x mr-2 text-primary"></i></span>
                                <span><i class="fab fa-instagram mr-2 fa-2x text-danger"></i></span>
                                <span><i class="fab fa-twitter mr-2 fa-2x text-info"></i></span>
                            </p>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row">
                        <div class="col-12 my-3">
                            <p class="copyright text-center">Policy and Terms</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- login Modal -->
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="row" class="modal-content">
                    <div class="col-md-12 mx-auto m-5 card" style="margin: 0px auto !important;">
                        <div class="row">
                            <div class="col-4 text-center" style="background-image: url('/img/food6.jpg');
                                background-repeat: no-repeat;
                                background-position: center;
                                background-size: cover;
                                opacity: 0.8;">
                                <img src="/img/tibetanbusiness.png" alt="" style="top:50%">
                            </div>
                            <div class="col-8">
                                <!-- Header -->
                                <div class="py-3 text-center">
                                    <h6 class="text-secondary">Login with Tibetanbusiness.com</h6>
                                    <div class="dropdown-divider"></div>
                                </div>
                                <!-- form -->
                                <div class="p-2">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="input-group mb-4">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="input-group mb-4">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-lock"></span>
                                                </div>
                                            </div>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="icheck-primary">
                                                    <input type="checkbox" id="remember">
                                                    <label for="remember" class="text-muted small">
                                                        Remember Me
                                                    </label>
                                                    <a class="btn btn-link text-right text-muted text-xs font-weight-bold" href="{{ route('password.request') }}">
                                                        {{ __('Forgot Your Password?') }}
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-12 py-2">
                                                <button type="submit" class="btn btn-success btn-flat btn-block">Sign In</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="dropdown-divider"></div>
                                <!-- Social Login -->
                                <div class="py-2">
                                    <h4 class="text-muted text-center small font-weight-bold py-2">OR LOGIN USING</h4>
                                    <div class="row">
                                        <div class="col-6 py-2">
                                            <a href="{{url('login/facebook')}}" class="btn btn-block  btn-primary">
                                                <i class="fab fa-facebook mr-1"></i>Facebook
                                            </a>
                                        </div>
                                        <div class="col-6 py-2">
                                            <a href="{{ url('login/google') }}" class="btn btn-block btn-danger">
                                                <i class="fab fa-google-plus mr-2"></i>Google
                                            </a>
                                        </div>
                                        <div class="col-6 py-2">
                                            <a href="{{url('login/github')}}" class="btn btn-block btn-secondary">
                                                <i class="fab fa-github mr-2"></i> Github
                                            </a>
                                        </div>
                                        <!-- <div class="col-6 py-2">
                                            <a href="{{url('login/twitter')}}" class="btn btn-block" style="background-color:#329deb;color:white">
                                                <i class="fab fa-twitter mr-2"></i> Twitter
                                            </a>
                                        </div> -->
                                    </div>
                                </div>
                                <!-- Create new password -->
                                <div class="py-2">
                                    <p class="text-muted font-weight-bold text-center">Don't have an account? <a class="btn btn-danger btn-sm" href="{{ route('register') }}">Signup</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Scripts -->
    @if(Request::is('/'))
    <!-- <script src="/js/main.js"></script> -->
    <script rel="preload" src="{{ asset('js/app.min.js') }}"></script>
    @endif
    @if(!Request::is('/'))
    <script rel="preload" src="{{ asset('js/detail.min.js') }}"></script>
    <script src="{{ asset('js/jquery.ui.min.js') }}"></script>
    <script src="{{ asset('js/share.js') }}"></script>
    @endif
    <script>
        // Fixed Navbar
        // Background change on
        // Scroll
        $(window).on("scroll", function() {
            if ($(window).scrollTop() > 10) {
                $("#navbar").addClass("sticky_header");
            } else {
                //remove the background property so it comes transparent again (defined in your css)
                $("#navbar").removeClass("sticky_header");
            }
        });
        // Clearing the storage
        $("#clear_storage").click(function() {
            localStorage.removeItem('token');
            // Remove User Object
            localStorage.removeItem('user_name');
            localStorage.removeItem('user_id');
            localStorage.removeItem('user_avatar');
            axios.get('/api/restaurant/list/all')
                .then(response => {
                    console.log(response);
                })
        });
        /**@abstract
         * Search 
         * Filter
         * Find
         *  */

        // location close
        $("#location_close").click(function() {
            $("#location_list").css("display", "none");
        })
        // service close
        $("#service_close").click(function() {
            $("#service_list").css("display", "none");
        })
    </script>

    <!-- Lazy loading image -->
    <script>
        function loadJS(u) {
            var r = document.getElementsByTagName("script")[0],
                s = document.createElement("script");
            s.src = u;
            r.parentNode.insertBefore(s, r);
        }

        if (!window.HTMLPictureElement || !('sizes' in document.createElement('img'))) {
            loadJS("ls.respimg.min.js");
        }
    </script>
    <script src="{{ asset('js/lazysizes.min.js') }}"></script>
    <script src="{{ asset('js/lazysizes.bgset.min.js') }}"></script>
    <!-- mapbox -->
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.2.2/plugins/bgset/ls.bgset.min.js"></script> -->
</body>

</html>