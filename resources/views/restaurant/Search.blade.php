@extends('welcome')
@section('content')
<restaurant-search v-bind:location="{{json_encode($location)}}"></restaurant-search>
@endsection