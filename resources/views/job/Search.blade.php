@extends('welcome')
@section('title', 'Job Result')
@section('content')
<job-search v-bind:location="{{json_encode($location)}}"></job-search>
@endsection