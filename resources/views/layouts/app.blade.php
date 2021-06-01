<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" prefix="og: https://ogp.me/ns#">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-87FMRJ2QCF"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-87FMRJ2QCF');
    </script>
    <!-- Google Adsense -->
    <script data-ad-client="ca-pub-4861711653689806" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ MetaTag::get('title') }}</title>
    {!! MetaTag::tag('description') !!}
    {!! MetaTag::tag('image') !!}
    <!-- Faceboook share -->
    {!! MetaTag::openGraph() !!}
    <!-- Twitter Share -->
    {!! MetaTag::twitterCard() !!}
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" sizes="72x72" href="{{asset('/img/tibetanbusiness.png')}}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    @if((Request::is('search/Events')) || (Request::is('search/Sales')) || (Request::is('search/Rents')) || (Request::is('search/Announcements')))
    <!-- JQUERY UI -->
    <link href="{{ asset('css/jquery.ui.min.css') }}" rel="stylesheet">
    @endif
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- fontawesome -->
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <!--bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Loading -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/placeholder-loading/dist/css/placeholder-loading.min.css">
    <!-- MapMyIndia -->
    <script src="https://apis.mapmyindia.com/advancedmaps/v1/b26z3h8ijubhswa1o73rmmgirc3tpx9z/map_load?v=1.3"></script>
    <!-- social Sharing -->
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=60222a551e16b800121b009b&product=sop' async='async'></script>
    <!-- <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5cf249f9f69849001202e135&product=inline-share-buttons' async='async'></script> -->
    <!-- AOS -->
    @if(Request::is('promote-business'))
    <link href="{{ asset('css/aos.min.css') }}" rel="stylesheet">
    @endif
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
                        </ul>
                        @else
                        <ul class="navbar-nav d-none d-sm-block">
                            <li class="nav-item d-sm-inline-block">
                                <a href="index3.html" class="nav-link">Add Business</a>
                            </li>
                            <!-- <li class="nav-item d-sm-inline-block">
                                <a href="#" class="nav-link">Promote Business</a>
                            </li> -->
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
                                <ul class="navbar-nav">
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
            <div style="min-height:100vh">
                @yield('content')
            </div>
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
                    <div class="row py-3">
                        <div class="col-6 text-center">
                            <p>
                                @guest
                                <a href="#" class="text-white-50 mx-1" data-toggle="modal" data-target="#login">Add Business</a>

                                @else
                                <a href="/dashboard/event" class="text-white-50 mx-1">Add Business</a>

                                @endguest
                                </span>
                                <span><a href="/promote-business" class="text-white-50 mx-1">Promote Business</a></span>
                                <span><a href="/contact-us" class="text-white-50 mx-1">Contact Us</a></span>
                            </p>
                            <p class="copyright">
                                <span><a href="https://www.facebook.com/tibetanbusiness/"><i class="fab fa-facebook-square fa-2x mr-2 text-primary"></i></a></span>
                                <span><a href="https://www.instagram.com/tibetanbusinesscom/"><i class="fab fa-instagram mr-2 fa-2x text-danger"></i></a></span>
                                <span><a href="https://twitter.com/Tibetanbusines1"><i class="fab fa-twitter mr-2 fa-2x text-info"></i></a></span>
                                <span><a href="https://in.linkedin.com/company/tibetanbusiness-com?trk=public_profile_topcard-current-company"><i class="fab fa-linkedin mr-2 fa-2x text-primary"></i></a></span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <map-location :longitude="76.32" :latitude="32.23"></map-location>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row">
                        <div class="col-12 my-1">
                            <p class="copyright text-center"> Tibetanbusiness © Copyright <?php echo date('Y'); ?> | Policy and Terms</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- login Modal -->
    <div class="px-4 modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="row" class="modal-content">
                    <div class="col-md-12 mx-auto m-5 card" style="margin: 0px auto !important;">
                        <div class="row">
                            <div class="col-4 text-center" style="background-image: url('/img/food12.jpg');
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
    <!-- Search Modal -->

    </div>
    <!-- Scripts -->
    @if(Request::is('/'))
    <script rel="preload" src="{{ asset('js/app.min.js') }}"></script>
    <link rel="preload" type="text/javascript" as="script" href="{{ asset('js/app.min.js') }}">
    @endif
    @if(!Request::is('/'))
    <script rel=" preload" src="{{ asset('js/detail.min.js') }}"></script>
    <link rel="preload" type="text/javascript" as="script" href="{{ asset('js/detail.min.js') }}">
    @endif
    @if((Request::is('search/Events')) || (Request::is('search/Sales')) || (Request::is('search/Rents')) || (Request::is('search/Announcements')))
    <!-- Jquery UI -->
    <script src="{{ asset('js/jquery.ui.min.js') }}"></script>
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
    <!-- AOC -->
    @if(Request::is('promote-business'))
    <script src="{{ asset('js/aos.min.js') }}"></script>
    <script>
        AOS.init({
            easing: 'ease-out-back',
            duration: 1000
        });
    </script>
    @endif
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
    <!-- Lazy loading -->
    <script src="{{ asset('js/lazysizes.min.js') }}"></script>
    <script src="{{ asset('js/lazysizes.bgset.min.js') }}"></script>
</body>

</html>