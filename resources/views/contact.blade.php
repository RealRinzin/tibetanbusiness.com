@extends('welcome')
@section('content')
<div style="min-height:100vh" class="bg-light">
    <div class="container">
        <div class="row py-4">
            <div class="col-12">
                <h4 class="text-dark">CONTACT US FOR INQUIRY</h3>
            </div>
        </div>
        <email-us></email-us>

        <div class="row">
            <div class="col-12 bg-light">
                <!-- <div id='contact-page-map' class="position-relative w-100" style="top:0;bottom:0"></div> -->
            </div>
        </div>
    </div>
    <div id="map" class="w-50 mx-auto" style="height:450px"></div>
</div>
@endsection