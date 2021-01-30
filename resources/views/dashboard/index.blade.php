@extends('dashboard')
@section('content')
    <div class="row py-5">
        <!-- Restaurants -->
        <div class="col-md-4">
            <div class="small-box bg-danger">
                <div class="inner">
                    <p>Restaurants</p>
                    <h3>150 +</h3>
                </div>
                <div class="icon">
                    <i class="fas fa-pizza-slice"></i>
                </div>
                <a href="/dashboard/restaurant" class="small-box-footer">Add Restaurants here <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- events -->
        <div class="col-md-4">
            <div class="small-box bg-warning">
                <div class="inner">
                    <p>Events</p>
                    <h3>10 +</h3>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <a href="/dashboard/event" class="small-box-footer">Add Events here <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- Rents -->
        <div class="col-md-4">
            <div class="small-box bg-info">
                <div class="inner">
                    <p>Rents</p>
                    <h3>16+</h3>
                </div>
                <div class="icon">
                    <i class="fas fa-bed"></i>
                </div>
                <a href="/dashboard/rent" class="small-box-footer">Add Rents here <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- Job -->
        <div class="col-md-4">
            <div class="small-box bg-success">
                <div class="inner">
                    <p>Jobs</p>
                    <h3>10 +</h3>
                </div>
                <div class="icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <a href="/dashboard/job" class="small-box-footer">Add Jobs here <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- Sales -->
        <div class="col-md-4">
            <div class="small-box bg-primary">
                <div class="inner">
                    <p>Sales / Purchase</p>
                    <h3>10 +</h3>
                </div>
                <div class="icon">
                    <i class="fas fa-rupee-sign"></i>
                </div>
                <a href="/dashboard/sale" class="small-box-footer">Add Sale here <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- Service -->
        <div class="col-md-4">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <p>Service Centre</p>
                    <h3>14 +</h3>
                </div>
                <div class="icon">
                    <i class="fas fa-tools"></i>
                </div>
                <a href="/dashboard/service" class="small-box-footer">Add Services here <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@endsection