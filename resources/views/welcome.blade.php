@extends('layouts.app')
@section('content')
<div id="home_search">
    <div class="container py-5">
        <div class="row">
            <!-- logo -->
            <!-- <div class="col-md-12 d-flex justify-content-center">
                <img src="img/tibetanbusiness.png" alt="Tibetanbusiness logo" class="elevation-3" style="opacity: .8">
            </div> -->
            <!-- Text -->
            <div class="col-md-12 py-4">
                <h3 class="text-white text-center">Find the best Tibetan Restaurants,Food corner and cafe shop in India</h3>
            </div>
            <!-- <search></search> -->
            <!-- search box -->
            <!-- <div class="col-md-6 mx-auto" id="tb_search_dropdown">
                <div class="input-group input-group-lg mb-3" id="tb_type">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                            Action
                        </button>
                        <ul class="dropdown-menu" id="target">
                            <li class="dropdown-item"><a href="#">Action</a></li>
                            <li class="dropdown-item"><a href="#">Another action</a></li>
                            <li class="dropdown-item"><a href="#">Something else here</a></li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item"><a href="#">Separated link</a></li>
                        </ul>
                    </div>
                    <input type="text" id="service_search" class="form-control" readonly="readonly" onfocusin="service_dropdown()">
                    <ul id="service_list" style="display:none;transition:1s">
                        <li value="Sales"><a href="#"> <span class="mr-2"><img src="img/money.png"></span> Sales</a></li>
                        <li value="Rents"><a href="#"> <span class="mr-2"><img src="img/rent.png"></span> Rents</a></li>
                        <li value="Events"><a href="#"> <span class="mr-2"><img src="img/birthday.png"></span> Events</a></li>
                        <li value="Jobs"><a href="#"> <span class="mr-2"><img src="img/opportunity.png"></span> Jobs</a></li>
                        <li value="Services"><a href="#"><span class="mr-2"><img src="img/mechanic.png"></span> Services</a></li>
                        <li value="Restaurants"><a href="#"> <span class="mr-2"><img src="img/chef.png"></span> Restaurants</a></li>
                    </ul>
                    <div id="dropdown" style="display:none;transition:1s">
                    </div>
                    <div class="input-group-append">
                        <a type="submit" id="link" class="btn btn-danger">
                            <i class="fas fa-search"></i>
                        </a>
                    </div>
                </div>
            </div> -->
            <div class="col-md-8 mx-auto mb-5" id="tb_search_dropdown">
                <form method="get" action="search/">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-5 px-0 col-12" id="tb_location">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-pin text-muted fa-2x"></i></span>
                                </div>
                                <input type="text" name="location" id="location_search" onfocusin="location_dropdown()" class="form-control" readonly="readonly" placeholder="Location" aria-label="Location" required>
                                <ul id="location_list" style="display:none;transition:1s">
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
                        </div>
                        <div class="col-md-5 px-0 col-12" id="tb_type">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fas fa-search fa-2x"></i>
                                    </span>
                                </div>
                                <input type="text" id="service_search" onfocusin="service_dropdown()" class="form-control" readonly="readonly" placeholder="Service Type" aria-label="service type" required>
                                <ul id="service_list" style="display:none;transition:1s">
                                    <li value="Sales"><a href="#"> <span class="mr-2"><img src="img/money.png"></span> Sales</a></li>
                                    <li value="Rents"><a href="#"> <span class="mr-2"><img src="img/rent.png"></span> Rents</a></li>
                                    <li value="Events"><a href="#"> <span class="mr-2"><img src="img/birthday.png"></span> Events</a></li>
                                    <li value="Jobs"><a href="#"> <span class="mr-2"><img src="img/opportunity.png"></span> Jobs</a></li>
                                    <li value="Services"><a href="#"><span class="mr-2"><img src="img/mechanic.png"></span> Services</a></li>
                                    <li value="Restaurants"><a href="#"> <span class="mr-2"><img src="img/chef.png"></span> Restaurants</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-2 px-0 col-12">
                            <div class="input-group-append" id="my-link">
                                <a href="" id="link" type="submit" class="btn btn-danger w-50">
                                    <i class="fas fa-search fa-2x"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>
<div id="home_featured" class="py-4" style="min-height: 100vh">
    <home-featured></home-featured>
</div>
@endsection