@extends('layouts.app')
@section('content')
<div id="home_search">
    <div class="container py-5">
        <div class="row">
            <!-- logo -->
            <div class="col-md-12 d-flex justify-content-center">
                <img src="img/tibetanbusiness.png" alt="Tibetanbusiness logo" class="elevation-3" style="opacity: .8">
            </div>
            <!-- Text -->
            <div class="col-md-12 py-4">
                <h3 class="text-white text-center">Find the best Tibetan Restaurants,Food corner and cafe shop in India</h3>
            </div>
            <!-- <search></search> -->
            <!-- search box -->
            <div class="col-md-8 mx-auto">
                <div class="input-group input-group-lg mb-3">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                            Action
                        </button>
                        <ul class="dropdown-menu">
                            <li class="dropdown-item"><a href="#">Action</a></li>
                            <li class="dropdown-item"><a href="#">Another action</a></li>
                            <li class="dropdown-item"><a href="#">Something else here</a></li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item"><a href="#">Separated link</a></li>
                        </ul>
                    </div>
                    <!-- btn-group -->

                    <input type="text" class="form-control" onfocus="check()" onkeydown="return false">
                    <div id="dropdown" style="display:none">
                        <ul>
                            <li>Events</li>
                            <li>Sales</li>
                            <li>Rents</li>
                            <li>Jobs</li>
                            <li>Services</li>
                            <li>Restaurants</li>
                        </ul>
                    </div>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div id="home_featured" class="py-4" style="min-height: 100vh">
    <home-featured></home-featured>
</div>
@endsection
<script>
    function check() {
        $("#dropdown").css("display", "block");

    }
</script>