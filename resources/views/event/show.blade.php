@extends('welcome')
@section('content')
<div class="container py-1">
    <div class="row">
        <div class="col-12">
        <div class="ssk-group ssk-coun ssk-sm">
                <a href="" class="ssk ss-icon ssk-facebook"></a>
                <a href="" class="ssk ssk-twitter"></a>
                <a href="" class="ssk ssk-pinterest"></a>
                <a href="" class="ssk ssk-tumblr"></a>
            </div>
        </div>
    </div>
</div>
<event-show :event_id="{{$id}}"></event-show>
@endsection