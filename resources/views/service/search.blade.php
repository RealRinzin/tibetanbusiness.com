@extends('welcome')
@section('content')
<service-search :location="{{json_encode($location)}}"></service-search>
@endsection