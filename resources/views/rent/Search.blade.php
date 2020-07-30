@extends('welcome')
@section('title', 'Rents Result..')
@section('content')
<rent-search v-bind:location="{{json_encode($location)}}"></rent-search>
@endsection