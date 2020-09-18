@extends('welcome')
@section('content')
<event-show :event_id="{{$id}}"></event-show>
@endsection