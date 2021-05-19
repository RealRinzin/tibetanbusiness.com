<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ MetaTag::get('title') }}</title>
    {!! MetaTag::tag('description') !!}
    {!! MetaTag::tag('image') !!}
    <!-- Faceboook share -->
    {!! MetaTag::openGraph() !!}
    <!-- Twitter Share -->
    {!! MetaTag::twitterCard() !!}
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/dashboard.min.css') }}" rel="stylesheet">
    <!-- fontawesome -->
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <!-- Adminlte -->
    <link href="{{ asset('css/adminlte.min.css') }}" rel="stylesheet">
    <link rel="icon" sizes="72x72" href="{{asset('/img/tibetanbusiness.png')}}">
    <!-- Datetime picker -->
    <link href="{{ asset('css/datetimepicker.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- mapmyindia -->
    <script src="https://apis.mapmyindia.com/advancedmaps/v1/b26z3h8ijubhswa1o73rmmgirc3tpx9z/map_load?v=1.3"></script>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="dashboard-app">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/dashboard" class="nav-link">Home</a>
                </li>
                <!-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="" class="nav-link">Contact</a>
                </li> -->
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <div class="dropdown show">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{Auth::user()->avatar}}" alt="" class="img-fluid img-circle" style="height: 30px;height:30px">
                        <!-- {{ Auth::user()->name }} --> <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            <!-- <a class="dropdown-item" @click="logout()" v-bind:href="logout">logout</a> -->
                            <button id="clear_storage" type="submit" class="dropdown-item">Logout</button>
                            @csrf
                        </form>
                    </div>
                </div>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link text-center">
                <img src="{{asset('img/tibetanbusiness.png')}}" alt="Tibetanbusiness.com logo" class="img-circle elevation-3" style="opacity: .8;height:30px;width:30px">
                <p class="brand-text font-weight-light">Tibetanbusiness.com</p>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{Auth::user()->avatar}}" alt="Tibetanbusiness Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"> {{Auth::user()->name}}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{route('dashboard.sale')}}" class="nav-link">
                                <i class="fas fa-tags mr-2"></i>
                                <p>Sales</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('dashboard.job')}}" class="nav-link">
                                <i class="fas fa-briefcase mr-2"></i>
                                <p>Jobs / Announcements</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.rent') }}" class="nav-link">
                                <i class="fa fa-bed mr-2"></i>
                                <p>Rents</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('dashboard.event')}}" class="nav-link">
                                <i class="fas fa-calendar-alt mr-2 "></i>
                                <p>Events</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('dashboard.service')}}" class="nav-link">
                                <i class="fas fa-tools mr-2"></i>
                                <p>Services</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.restaurant') }}" class="nav-link">
                                <i class="fa fa-hamburger mr-2"></i>
                                <p>Restaurants</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="dashboard">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    @yield('content')
                </div>
            </div>
            <!-- /.content-header -->
        </div>
        <!-- /.content-wrapper -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        <!-- Main Footer -->
        <footer class="main-footer text-center p-3 small">
            <strong>Copyright &copy; <?php echo date("Y") ?> <a href="https://www.tibetanbusiness.com">Tibetanbusiness Co</a></strong>
            All rights reserved.
        </footer>
    </div>
    <!-- REQUIRED SCRIPTS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <script src="{{ asset('js/datetimepicker.min.js') }}"></script>
    <!-- Custom components vue -->
    <script src="{{ asset('js/dashboard.min.js') }}"></script>
    <link rel="preload" type="text/javascript" as="script" href="{{ asset('js/dashboard.min.js') }}">

    <script src="{{ asset('js/vue-js-toggle.min.js') }}"></script>
    <!-- jquery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $("#clear_storage").click(function() {
            localStorage.removeItem('token');
            // Remove User Object
            localStorage.removeItem('user_name');
            localStorage.removeItem('user_id');
            localStorage.removeItem('user_avatar');
        });
    </script>
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
</body>

</html>