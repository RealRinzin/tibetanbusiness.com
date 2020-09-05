@extends('layouts.app')
@section('content')

<div style="min-height: 70vh">
    <search></search>
</div>
<div id="home_featured" class="py-4" style="min-height: 100vh">
    <home-featured></home-featured>
</div>
<!-- Total counts  -->
<div class="container">
    <h5 class="py-2 text-center font-weight-bolder m-0">Businesses Listed </h5>
    <p class="text-center text-muted font-weight-bolder small m-0 py-1">Count 120+<p>
            <div class="row">
                <div class="col-md-2 col-sm-3 col-6">
                    <div class="card text-center p-4">
                        <i class="fas fa-mug-hot fa-4x"></i>
                        <p class="text-dark font-weight-bold small m-0 pt-3">RESTAURANTS</p>
                        <p class="text-muted font-weight-bold small m-0 pt-1">42+</p>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-6">
                    <div class="card text-center p-4">
                        <i class="fas fa-money-bill-alt fa-4x"></i>
                        <p class="text-dark font-weight-bold small m-0 pt-3">SALES</p>
                        <p class="text-muted font-weight-bold small m-0 pt-1">62+</p>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-6">
                    <div class="card text-center p-4">
                        <i class="fas fa-calendar-alt fa-4x"></i>
                        <p class="text-dark font-weight-bold small m-0 pt-3">EVENTS</p>
                        <p class="text-muted font-weight-bold small m-0 pt-1">42+</p>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-6">
                    <div class="card text-center p-4">
                        <i class="fas fa-briefcase fa-4x"></i>
                        <p class="text-dark font-weight-bold small m-0 pt-3">JOBS</p>
                        <p class="text-muted font-weight-bold small m-0 pt-1">42+</p>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-6">
                    <div class="card text-center p-4">
                        <i class="fas fa-bed fa-4x"></i>
                        <p class="text-dark font-weight-bold small m-0 pt-3">RENTS</p>
                        <p class="text-muted font-weight-bold small m-0 pt-1">42+</p>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-6">
                    <div class="card text-center p-4">
                        <i class="fas fa-tools fa-4x text-muted"></i>
                        <p class="text-dark font-weight-bold small m-0 pt-3">SERVICES</p>
                        <p class="text-muted font-weight-bold small m-0 pt-1">42+</p>
                    </div>
                </div>
            </div>
</div>
@endsection