@extends('welcome')
@section('content')
<sale-search :location="{{json_encode($location)}}"></sale-search>
@endsection