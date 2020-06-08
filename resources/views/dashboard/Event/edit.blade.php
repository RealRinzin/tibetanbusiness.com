@extends('dashboard')
@section('content')
<dashboard-event-edit :event_id="{{$id}}"></dashboard-event-edit>
@endsection