@extends('welcome')
@section('content')
<job-show :job_id="{{$id}}"></job-show>
@endsection