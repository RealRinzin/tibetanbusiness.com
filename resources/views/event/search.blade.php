@extends('welcome')
@section('title', 'Jobs')
@section('content')
<event-search v-bind:location="{{json_encode($location)}}"></event-search>
@endsection