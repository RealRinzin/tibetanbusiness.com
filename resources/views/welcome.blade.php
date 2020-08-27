@extends('layouts.app')
@section('content')
<search></search>
<!-- <div id="home_search">
    <div class="container py-5">
        <div class="row py-5">
            <div class="col-md-12 py-4">
                <h3 class="text-white text-center">Find the best Tibetan Restaurants,Food corner and cafe shop in India</h3>
            </div>
            <div class="col-md-9 mx-auto mb-5 col-11" id="tb_search_dropdown">
                <form method="get" action="#">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-5 px-0 col-sm-5 col-12" id="tb_location">
                            <div class="input-group mb-3 input-group-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-pin text-muted"></i></span>
                                </div>
                                <input type="text" name="location" id="location_search" onfocusin="location_dropdown()" class="form-control" readonly="readonly" placeholder="Location" aria-label="Location" required>
                                <ul id="location_list" style="display:none;transition:1s">
                                    <button type="button" id="location_close" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
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
                        <div class="col-md-5 px-0 col-sm-5 col-12" id="tb_type">
                            <div class="input-group mb-3 input-group-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fas fa-tools"></i>
                                    </span>
                                </div>
                                <input type="text" id="service_search" onfocusin="service_dropdown()" class="form-control" readonly="readonly" placeholder="Service" aria-label="service type" required>
                                <ul id="service_list" style="display:none;transition:1s">
                                    <button type="button" id="service_close" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <li value="Sales"><a href="#"> <span class="mr-2"><img src="img/money.png"></span> Sales</a></li>
                                    <li value="Rents"><a href="#"> <span class="mr-2"><img src="img/rent.png"></span> Rents</a></li>
                                    <li value="Events"><a href="#"> <span class="mr-2"><img src="img/birthday.png"></span> Events</a></li>
                                    <li value="Jobs"><a href="#"> <span class="mr-2"><img src="img/opportunity.png"></span> Jobs</a></li>
                                    <li value="Services"><a href="#"><span class="mr-2"><img src="img/mechanic.png"></span> Services</a></li>
                                    <li value="Restaurants"><a href="#"> <span class="mr-2"><img src="img/chef.png"></span> Restaurants</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-2 px-0 col-sm-2 col-12">
                            <div class="input-group-append">
                                <button id="link" type="submit" class="btn btn-danger w-75">
                                    <i class="fas fa-search fa-2x"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div id="list" class="text-left small text-muted font-weight-bold py-2">
                    <span class="d-inline p-2 text-white"><a href="search/Events"><i class="fas fa-calendar-alt"></i> EVENTS</a></span>
                    <span class="d-inline p-2 text-white"><a href="search/Sales"><i class="fas fa-money-bill-alt"></i> SALES</a></span>
                    <span class="d-inline p-2 text-white"><a href="search/Rents"><i class="fas fa-bed"></i> RENTS</a></span>
                    <span class="d-inline p-2 text-white"><a href="search/Jobs"><i class="fas fa-briefcase"></i> JOBS</a></span>
                    <span class="d-inline p-2 text-white"><a href="search/Services"><i class="fas fa-tools"></i> SERVICES</a></span>
                    <span class="d-inline p-2 text-white"><a href="search/Restaurants"><i class="fas fa-pizza-slice"></i> RESTAURANTS</a></span>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div id="home_featured" class="py-4" style="min-height: 100vh">
    <home-featured></home-featured>
</div>
@endsection