<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/dashboard.min.css') }}" rel="stylesheet">
    <!-- fontawesome -->
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <!-- Adminlte -->
    <link href="{{ asset('css/adminlte.min.css') }}" rel="stylesheet">
    <link rel="icon" sizes="72x72" href="{{asset('/tibetanbusiness.png')}}">
    <!-- Datetime picker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="dashboard-app">
        <vue-progress-bar></vue-progress-bar>
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
                            <a href="{{ route('dashboard.restaurant') }}" class="nav-link">
                                <i class="fa fa-calendar-alt mr-2"></i>
                                <p>Restaurants<span class="right badge badge-danger">New</span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard.rent') }}" class="nav-link">
                                <i class="fa fa-calendar-alt mr-2"></i>
                                <p>Rents<span class="right badge badge-danger">New</span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('dashboard.job')}}" class="nav-link">
                                <i class="fas fa-utensils mr-2"></i>
                                <p>Job<span class="right badge badge-danger">New</span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('dashboard.event')}}" class="nav-link">
                                <i class="fas fa-hotel mr-2 "></i>
                                <p>Event<span class="right badge badge-danger">New</span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('dashboard.sale')}}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Sales<span class="right badge badge-danger">New</span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('dashboard.service')}}" class="nav-link">
                                <i class="fas fa-home mr-2 text-danger"></i>
                                <p>Services<span class="right badge badge-danger">New</span></p>
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
            <!-- <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.0.4
            </div> -->
        </footer>
    </div>
    <!-- REQUIRED SCRIPTS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.4/js/adminlte.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.0/js/bootstrap.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
    <!-- Custom components vue -->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    <script src="{{ asset('js/dashboard.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-js-toggle-button/1.3.3/index.min.js"></script>
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
</body>

</html>