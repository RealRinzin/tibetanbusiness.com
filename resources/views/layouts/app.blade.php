<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title> @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta property="og:url" content="http://www.nytimes.com/2015/02/19/arts/international/when-great-minds-dont-think-alike.html" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="When Great Minds Don’t Think Alike" />
    <meta property="og:description" content="How much does culture influence creative thinking?" />
    <meta property="og:image" content="http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" sizes="72x72" href="{{asset('tibetanbusiness.png')}}">
    <!-- <title>{{ config('app.name', 'Tibetanbusiness.com') }}</title> -->
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
                    <!-- SEARCH FORM -->
                    @if(Request::is('/'))
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item d-sm-inline-block">
                            <a href="index3.html" class="nav-link">Add Business</a>
                        </li>
                        <li class="nav-item d-sm-inline-block">
                            <a href="#" class="nav-link">Promote Business</a>
                        </li>
                    </ul>
                    @else
                    <ul class="navbar-nav" id="desktop_add_promote_link">
                        <li class="nav-item d-sm-inline-block">
                            <a href="index3.html" class="nav-link">Add Business</a>
                        </li>
                        <li class="nav-item d-sm-inline-block">
                            <a href="#" class="nav-link">Promote Business</a>
                        </li>
                    </ul>
                    <div class="row mx-auto">
                        <div class="col-md-12">
                            <div id="tb_mobile_search_dropdown">
                                <form class="form-inline ml-3" method="get" action="">
                                    {{ csrf_field() }}
                                    <span class="w-50">
                                        <div class="input-group input-group-sm">
                                            <input style="border-radius:3px 0px 0px 3px" type="text" name="location" id="location_search" onfocusin="location_dropdown()" class="form-control" readonly="readonly" placeholder="Location" aria-label="Location" required>
                                            <!-- <input style="border-radius:3px 0px 0px 3px" id="location_search" onfocusin="location_dropdown()" readonly="readonly" class="form-control form-control-navbar" type="search" placeholder="Location" aria-label="Location"> -->
                                            <ul id="location_list" style="display:none;transition:1s" class="position-absolute rounded">
                                                <li value="Dharamsala"><a href="#">Dharamsala</a></li>
                                                <li value="Delhi"><a href="#">Delhi</a></li>
                                                <li value="Dehradun"><a href="#">Dehradun</a></li>
                                                <li value="Dharamsala"><a href="#">Dehradun</a></li>
                                                <li value="Dharamsala"><a href="#">Dharamsala</a></li>
                                                <li value="Delhi"><a href="#">Delhi</a></li>
                                                <li value="Dehradun"><a href="#">Dehradun</a></li>
                                                <li value="Dharamsala"><a href="#">Dehradun</a></li>
                                                <li value="Dharamsala"><a href="#">Dharamsala</a></li>
                                                <li value="Delhi"><a href="#">Delhi</a></li>
                                                <li value="Dehradun"><a href="#">Dehradun</a></li>
                                                <li value="Dharamsala"><a href="#">Dehradun</a></li>
                                            </ul>
                                        </div>
                                    </span>
                                    <span class="w-50">
                                        <div class="input-group input-group-sm">
                                            <input id="service_search" class="rounded-0 form-control form-control-navbar" onfocusin="service_dropdown()" readonly="readonly" type="search" placeholder="Service" aria-label="Service type">
                                            <ul id="service_list" style="display:none;transition:1s" class="position-absolute rounded overflow-hidden">
                                                <li value="Sales"><a href="#"> <span class="mr-2"><img src="/img/money.png"></span> Sales</a></li>
                                                <li value="Rents"><a href="#"> <span class="mr-2"><img src="/img/rent.png"></span> Rents</a></li>
                                                <li value="Events"><a href="#"> <span class="mr-2"><img src="/img/birthday.png"></span> Events</a></li>
                                                <li value="Jobs"><a href="#"> <span class="mr-2"><img src="/img/opportunity.png"></span> Jobs</a></li>
                                                <li value="Services"><a href="#"><span class="mr-2"><img src="/img/mechanic.png"></span> Services</a></li>
                                                <li value="Restaurants"><a href="#"> <span class="mr-2"><img src="/img/chef.png"></span> Restaurants</a></li>
                                            </ul>
                                            <div class="input-group-append">
                                                <button id="link" class="btn btn-navbar" type="submit">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </span>
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{Auth::user()->avatar}}" alt="" class="img-fluid img-circle">
                                    <!-- {{ Auth::user()->name }} --> <span class="caret"></span>
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
            @if(!Request::is('/'))
            <div class="alert alert-secondary alert-dismissible fade show m-1 rounded-0 text-center w-100" role="alert" id="mobile_add_promote_link">
                <button class="btn btn-warning">Add Business</button>
                <button class="btn btn-warning">Promote Business</button>
                <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
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
                                        <div class="col-6 py-2">
                                            <a href="{{url('login/twitter')}}" class="btn btn-block" style="background-color:#329deb;color:white">
                                                <i class="fab fa-twitter mr-2"></i> Twitter
                                            </a>
                                        </div>
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
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- jquery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('js/share.js') }}"></script>
    <script>
        // toast pop up for 
        // $('.toast').toast('show');
        var locate = "";
        var service = "";
        // location
        function location_dropdown() {
            $("#location_list").css("display", "block")
            $("#service_list").css("display", "none");
        }
        $("#location_list li").click(function() {
            let term = $(this).attr("value")
            $("#location_search").val(term);
            locate = term;
            // Closing the dropdown
            $("#location_list").css("display", "none");
            // removing required class
            $("#location_search").removeClass("required");

        });

        // Focus out
        // $("#location_search").focusout(function() {
        // })
        // Service
        function service_dropdown() {
            $("#service_list").css("display", "block")
            $("#location_list").css("display", "none")

        }
        $("#service_list li").click(function() {
            let term = $(this).attr("value")
            $("#service_search").val(term);
            service = term;
            // Closing the dropdown
            $("#service_list").css("display", "none");
            // Removing required class
            $("#service_search").removeClass("required");
        })
        // Adding text
        $("#link").click(function(event) {
            if (!service || !locate) {
                // console.log("empty");
                if (service) {
                    $("#service_search").removeClass("required");
                } else {
                    // Required Service
                    $("#service_search").addClass("required");
                    $("#service_search").attr("placeholder", "Select Service");
                }
                // location required
                if (locate) {
                    $("#location_search").removeClass("required");
                } else {
                    // Required Location
                    $("#location_search").addClass("required");
                    $("#location_search").attr("placeholder", "Select Location");
                }
                event.preventDefault();

            } else {
                $('form').attr('action', '/search/' + service + "?location=" + locate);
            }
        });
    </script>
</body>

</html>